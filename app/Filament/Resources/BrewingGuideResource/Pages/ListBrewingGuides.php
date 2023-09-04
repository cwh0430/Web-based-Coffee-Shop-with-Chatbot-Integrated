<?php

namespace App\Filament\Resources\BrewingGuideResource\Pages;

use App\Filament\Resources\BrewingGuideResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBrewingGuides extends ListRecords
{
    protected static string $resource = BrewingGuideResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
