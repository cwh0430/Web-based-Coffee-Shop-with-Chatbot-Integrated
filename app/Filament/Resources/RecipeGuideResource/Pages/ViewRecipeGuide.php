<?php

namespace App\Filament\Resources\RecipeGuideResource\Pages;

use App\Filament\Resources\RecipeGuideResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRecipeGuide extends ViewRecord
{
    protected static string $resource = RecipeGuideResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
