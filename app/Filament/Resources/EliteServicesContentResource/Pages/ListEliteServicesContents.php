<?php

namespace App\Filament\Resources\EliteServicesContentResource\Pages;

use App\Filament\Resources\EliteServicesContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEliteServicesContents extends ListRecords
{
    protected static string $resource = EliteServicesContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
