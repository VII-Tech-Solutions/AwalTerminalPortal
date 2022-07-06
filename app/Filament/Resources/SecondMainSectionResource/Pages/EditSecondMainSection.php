<?php

namespace App\Filament\Resources\SecondMainSectionResource\Pages;

use App\Filament\Resources\SecondMainSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSecondMainSection extends EditRecord
{
    protected static string $resource = SecondMainSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
