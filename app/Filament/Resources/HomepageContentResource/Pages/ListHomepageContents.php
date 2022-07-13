<?php

namespace App\Filament\Resources\HomepageContentResource\Pages;

use App\Filament\Resources\HomepageContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomepageContents extends ListRecords
{
    protected static string $resource = HomepageContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
