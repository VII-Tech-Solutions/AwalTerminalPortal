<?php

namespace App\Filament\Resources\FirstMainSectionResource\Pages;

use App\Filament\Resources\FirstMainSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFirstMainSections extends ListRecords
{
    protected static string $resource = FirstMainSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
