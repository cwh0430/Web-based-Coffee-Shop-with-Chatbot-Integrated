<?php

namespace App\Filament\Resources\EmbeddingCollectionResource\Pages;

use App\Filament\Resources\EmbeddingCollectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmbeddingCollection extends EditRecord
{
    protected static string $resource = EmbeddingCollectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
        ];
    }
}