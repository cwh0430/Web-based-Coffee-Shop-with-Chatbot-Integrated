<?php

namespace App\Filament\Resources\MechanicResource\Pages;

use App\Filament\Resources\MechanicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMechanic extends ViewRecord
{
    protected static string $resource = MechanicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
