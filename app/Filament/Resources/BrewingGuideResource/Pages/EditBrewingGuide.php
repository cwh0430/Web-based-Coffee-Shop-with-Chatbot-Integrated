<?php

namespace App\Filament\Resources\BrewingGuideResource\Pages;

use App\Filament\Resources\BrewingGuideResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBrewingGuide extends EditRecord
{
    protected static string $resource = BrewingGuideResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
