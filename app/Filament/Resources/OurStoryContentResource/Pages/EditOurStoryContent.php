<?php

namespace App\Filament\Resources\OurStoryContentResource\Pages;

use App\Filament\Resources\OurStoryContentResource;
use Filament\Resources\Pages\EditRecord;

class EditOurStoryContent extends EditRecord
{
    protected static string $resource = OurStoryContentResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
