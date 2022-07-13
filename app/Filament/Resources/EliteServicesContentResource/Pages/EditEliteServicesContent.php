<?php

namespace App\Filament\Resources\EliteServicesContentResource\Pages;

use App\Filament\Resources\EliteServicesContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEliteServicesContent extends EditRecord
{
    protected static string $resource = EliteServicesContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
