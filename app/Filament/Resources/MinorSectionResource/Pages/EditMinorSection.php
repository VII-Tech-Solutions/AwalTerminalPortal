<?php

namespace App\Filament\Resources\MinorSectionResource\Pages;

use App\Filament\Resources\MinorSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMinorSection extends EditRecord
{
    protected static string $resource = MinorSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
