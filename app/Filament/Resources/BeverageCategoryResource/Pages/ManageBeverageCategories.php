<?php

namespace App\Filament\Resources\BeverageCategoryResource\Pages;

use App\Filament\Resources\BeverageCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBeverageCategories extends ManageRecords
{
    protected static string $resource = BeverageCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
