<?php

namespace App\Filament\Resources\HomebrewProductResource\Pages;

use App\Filament\Resources\HomebrewProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHomebrewProduct extends ViewRecord
{
    protected static string $resource = HomebrewProductResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
