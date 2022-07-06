<?php

namespace App\Filament\Resources\SecondMainSectionResource\Pages;

use App\Filament\Resources\SecondMainSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSecondMainSections extends ListRecords
{
    protected static string $resource = SecondMainSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
