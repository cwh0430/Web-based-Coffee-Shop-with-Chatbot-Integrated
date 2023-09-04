<?php

namespace App\Filament\Resources\RecipeGuideResource\Pages;

use App\Filament\Resources\RecipeGuideResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecipeGuide extends EditRecord
{
    protected static string $resource = RecipeGuideResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
