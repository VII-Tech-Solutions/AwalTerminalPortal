<?php

namespace App\Filament\Resources\GeneralAviationContentResource\Pages;

use App\Filament\Resources\GeneralAviationContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGeneralAviationContents extends ListRecords
{
    protected static string $resource = GeneralAviationContentResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
