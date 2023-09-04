<?php

namespace App\Filament\Resources\RecipeGuideResource\Pages;

use App\Filament\Resources\RecipeGuideResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecipeGuides extends ListRecords
{
    protected static string $resource = RecipeGuideResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
