<?php

namespace App\Filament\Resources\EmbeddingCollectionResource\Pages;

use Filament\Pages\Actions;
use App\Services\VectorService;
use App\Models\EmbeddingCollection;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\EmbeddingCollectionResource;

class CreateEmbeddingCollection extends CreateRecord
{
    protected static string $resource = EmbeddingCollectionResource::class;

    protected function beforeCreate()
    {
        $existingCollection = EmbeddingCollection::all();
        if ($existingCollection->isNotEmpty()) {
            Notification::make()
                ->warning()
                ->title('File exists!')
                ->body('Delete the existing file before adding a new one.')
                ->persistent()
                ->send();

            $this->halt();
        }
    }

    protected function afterCreate()
    {
        $newCollection = EmbeddingCollection::first();
        $vectorService = new VectorService;
        $filePath = storage_path() . "/app/public/" . $newCollection->file_path;
        $vectorService->extractDataFromCSV($filePath);
    }
}