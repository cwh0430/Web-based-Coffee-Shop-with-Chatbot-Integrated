<?php

namespace App\Filament\Resources\HomebrewProductResource\Pages;

use App\Filament\Resources\HomebrewProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHomebrewProduct extends CreateRecord
{
    protected static string $resource = HomebrewProductResource::class;
}
