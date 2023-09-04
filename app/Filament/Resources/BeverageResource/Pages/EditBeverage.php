<?php

namespace App\Filament\Resources\BeverageResource\Pages;

use App\Filament\Resources\BeverageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBeverage extends EditRecord
{
    protected static string $resource = BeverageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
