<?php

namespace App\Filament\Resources\MechanicResource\Pages;

use App\Filament\Resources\MechanicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMechanics extends ListRecords
{
    protected static string $resource = MechanicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
