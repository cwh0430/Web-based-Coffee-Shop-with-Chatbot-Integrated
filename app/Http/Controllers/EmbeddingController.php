<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Embedding;
use Illuminate\Http\Request;
use App\Services\VectorService;
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;
use App\Imports\EmbeddingCollectionImport;

class EmbeddingController extends Controller
{
    public function askQuestionStreamed($context, $question)
    {
        $prompt =
            "You are a helpful ecommerce coffee website assistant.
        Respond to the Q based on the context information of our coffee products given : " . $context .
            "\n Q: " . $question .

            "\n If the answer to the question is not in the context, just say 'sorry I do not Know'";


        return OpenAI::chat()->createStreamed([
            'model' => 'gpt-3.5-turbo',
            'temperature' => 0.8,
            'messages' => [
                ['role' => 'system', 'content' => $prompt],
                ['role' => 'user', 'content' => $question],
            ],
        ]);
    }

    public function store(Request $req)
    {
        $question = $req->question;

        try {
            $vectorService = new VectorService;
            $questionVector = $vectorService->generateEmbedding($question);
            $relevantChunks = $vectorService->getMostSimilarVectors($questionVector);
            $similarTexts = $vectorService->getTextsFromIds(array_column($relevantChunks, 'id'));
            $context = implode(' ', $similarTexts);

            $responses = $this->askQuestionStreamed($context, $question);
            $resultText = "";

            foreach ($responses as $response) {
                $text = $response->choices[0]->delta->content;
                $resultText .= $text;
                if (connection_aborted()) {
                    break;
                }
            }

            return response()->json([
                'answer' => $resultText
            ]);

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

}