<?php

namespace App\Filament\Resources\HomebrewProductResource\Pages;

use App\Filament\Resources\HomebrewProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomebrewProducts extends ListRecords
{
    protected static string $resource = HomebrewProductResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
