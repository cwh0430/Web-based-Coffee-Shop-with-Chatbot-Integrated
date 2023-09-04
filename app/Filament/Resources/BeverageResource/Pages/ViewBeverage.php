<?php

namespace App\Filament\Resources\BeverageResource\Pages;

use App\Filament\Resources\BeverageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBeverage extends ViewRecord
{
    protected static string $resource = BeverageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
