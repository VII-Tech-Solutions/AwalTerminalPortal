<?php

namespace App\Filament\Resources\FooterSectionResource\Pages;

use App\Filament\Resources\FooterSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFooterSections extends ListRecords
{
    protected static string $resource = FooterSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
