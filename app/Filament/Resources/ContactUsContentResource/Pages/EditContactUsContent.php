<?php

namespace App\Filament\Resources\ContactUsContentResource\Pages;

use App\Filament\Resources\ContactUsContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactUsContent extends EditRecord
{
    protected static string $resource = ContactUsContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
