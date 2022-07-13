<?php

namespace App\Filament\Resources\ContactUsContentResource\Pages;

use App\Filament\Resources\ContactUsContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactUsContents extends ListRecords
{
    protected static string $resource = ContactUsContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
