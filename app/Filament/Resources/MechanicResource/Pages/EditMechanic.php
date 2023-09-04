<?php

namespace App\Filament\Resources\MechanicResource\Pages;

use App\Filament\Resources\MechanicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMechanic extends EditRecord
{
    protected static string $resource = MechanicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
