<?php

namespace App\Filament\Resources\GeneralAviationContentResource\Pages;

use App\Filament\Resources\GeneralAviationContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGeneralAviationContent extends EditRecord
{
    protected static string $resource = GeneralAviationContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
