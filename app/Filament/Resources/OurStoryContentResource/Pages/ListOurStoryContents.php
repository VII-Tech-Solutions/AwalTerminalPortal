<?php

namespace App\Filament\Resources\OurStoryContentResource\Pages;

use App\Filament\Resources\OurStoryContentResource;
use Filament\Resources\Pages\ListRecords;

class ListOurStoryContents extends ListRecords
{
    protected static string $resource = OurStoryContentResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
