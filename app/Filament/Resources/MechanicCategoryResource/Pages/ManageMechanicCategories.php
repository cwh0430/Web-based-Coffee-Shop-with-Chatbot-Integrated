<?php

namespace App\Filament\Resources\MechanicCategoryResource\Pages;

use App\Filament\Resources\MechanicCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMechanicCategories extends ManageRecords
{
    protected static string $resource = MechanicCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
