<?php

namespace App\Filament\Resources\TourTheTerminalContentResource\Pages;

use App\Filament\Resources\TourTheTerminalContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTourTheTerminalContents extends ListRecords
{
    protected static string $resource = TourTheTerminalContentResource::class;

    protected function getActions(): array
    {
        return [
        ];
    }
}
