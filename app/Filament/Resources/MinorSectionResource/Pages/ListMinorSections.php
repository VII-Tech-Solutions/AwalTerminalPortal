<?php

namespace App\Filament\Resources\MinorSectionResource\Pages;

use App\Filament\Resources\MinorSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMinorSections extends ListRecords
{
    protected static string $resource = MinorSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
