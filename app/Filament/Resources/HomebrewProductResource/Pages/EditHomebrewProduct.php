<?php

namespace App\Filament\Resources\HomebrewProductResource\Pages;

use App\Filament\Resources\HomebrewProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomebrewProduct extends EditRecord
{
    protected static string $resource = HomebrewProductResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
