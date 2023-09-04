<?php

namespace App\Filament\Resources\EmbeddingCollectionResource\Pages;

use App\Filament\Resources\EmbeddingCollectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEmbeddingCollection extends ViewRecord
{
    protected static string $resource = EmbeddingCollectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
