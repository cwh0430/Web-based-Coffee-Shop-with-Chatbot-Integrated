<?php

namespace App\Filament\Resources\EmbeddingCollectionResource\Pages;

use App\Filament\Resources\EmbeddingCollectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmbeddingCollections extends ListRecords
{
    protected static string $resource = EmbeddingCollectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
