<?php

namespace App\Filament\Resources\HomebrewProductCategoryResource\Pages;

use App\Filament\Resources\HomebrewProductCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHomebrewProductCategories extends ManageRecords
{
    protected static string $resource = HomebrewProductCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
