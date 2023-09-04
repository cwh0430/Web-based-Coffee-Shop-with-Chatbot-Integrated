<?php

namespace App\Services;

use Exception;
use App\Models\Vector;
use App\Models\Embedding;
use App\Models\TextVector;
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;
use App\Imports\EmbeddingCollectionImport;
use Maatwebsite\Excel\Facades\Excel;

class VectorService
{
    public function extractDataFromCSV($filePath)
    {
        $plainText = '';
        $sentences = '';
        $import = new EmbeddingCollectionImport;
        Excel::import($import, $filePath);

        foreach ($import->importedData as $index => $item) {
            if ($index === 0) {
                continue; // Skip the first row
            }
            $name = $item[0];
            $content = $item[1];
            $sentences .= $item[0] . " where contents are " . $item[1] . " ";
        }

        //tokenize the data
        $tokens = tokenize($sentences);
        $normalizedTokens = normalize_tokens($tokens);
        $cleanedText = implode(' ', $normalizedTokens);


        $wordsPerChunk = 1000; // number of words per chunk
        $overlapWords = 200; // number of overlapping words between chunks
        $pattern = '/\s+' . '\{1,' . ($wordsPerChunk + $overlapWords) . '\}(?=\s)/'; // regex pattern to split by words with overlap

        $chunks = preg_split($pattern, $cleanedText, -1, PREG_SPLIT_NO_EMPTY);
        $chunkCount = count($chunks);

        // Loop through the chunks and store each one as a vector
        foreach ($chunks as $a => $chunk) {
            $context = '';
            if ($a > 0) {
                $prevChunk = $chunks[$a - 1];
                $context = implode(' ', array_slice(explode(' ', $prevChunk), -$overlapWords));
            }
            if ($a < $chunkCount - 1) {
                $nextChunk = $chunks[$a + 1];
                $context .= ' ' . implode(' ', array_slice(explode(' ', $nextChunk), 0, $overlapWords));
            }

            $chunkWithContext = $context . ' ' . $chunk;

            $clearEmbeddingDatabase = Embedding::truncate();
            // Call the function to generate the embeddings for the context
            // if statement to ensure get the latest data from the file 
            if ($clearEmbeddingDatabase) {
                $vector = $this->generateEmbedding($chunkWithContext);
                // Store the chunk to the database
                Embedding::create([
                    'text' => $chunkWithContext,
                    'text_vector' => json_encode($vector),
                ]);
            }
        }
    }

    public function generateEmbedding($embeddingData): array
    {
        $vector = OpenAI::embeddings()->create([
            'model' => 'text-embedding-ada-002',
            'input' => $embeddingData,
        ]);

        if (count($vector['data']) == 0) {
            throw new Exception("Failed to generate embedding!");
        }

        return $vector['data'][0]['embedding'];
    }


    public function getTextsFromIds(array $ids): array
    {
        $texts = Embedding::whereIn('id', $ids)->get()->toArray();
        $textsById = [];

        foreach ($texts as $text) {
            $textsById[$text['id']] = $text['text'];
        }

        $textsOrderedByIds = [];

        foreach ($ids as $id) {
            if (isset($textsById[$id])) {
                $textsOrderedByIds[] = $textsById[$id];
            }
        }

        return $textsOrderedByIds;
    }

    public function getMostSimilarVectors(array $vector)
    {
        $vectors = Embedding::all()
            ->map(function ($vector) {
                return [
                    'id' => $vector->id,
                    'text' => $vector->text,
                    'text_vector' => json_decode($vector->text_vector, true)
                ];
            })
            ->toArray();

        $similarVectors = [];
        foreach ($vectors as $v) {
            $cosineSimilarity = $this->calculateCosineSimilarity($vector, $v['text_vector']);
            $similarVectors[] = [
                'id' => $v['id'],
                'similarity' => $cosineSimilarity
            ];
        }

        usort($similarVectors, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        return array_slice($similarVectors, 0);
    }

    private function calculateCosineSimilarity(array $v1, array $v2): float
    {
        $dotProduct = 0;
        $v1Norm = 0;
        $v2Norm = 0;

        foreach ($v1 as $i => $value) {
            $dotProduct += $value * $v2[$i];
            $v1Norm += $value * $value;
            $v2Norm += $v2[$i] * $v2[$i];
        }

        $v1Norm = sqrt($v1Norm);
        $v2Norm = sqrt($v2Norm);

        return $dotProduct / ($v1Norm * $v2Norm);
    }
}