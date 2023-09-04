<?php

namespace App\Filament\Resources\BrewingGuideResource\Pages;

use App\Filament\Resources\BrewingGuideResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBrewingGuide extends ViewRecord
{
    protected static string $resource = BrewingGuideResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
