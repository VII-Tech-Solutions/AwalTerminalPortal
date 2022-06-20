<?php

namespace App\Filament\Resources\CountryResource\Pages;

use App\Filament\Resources\CountryResource;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditCountry extends EditRecord
{
    protected static string $resource = CountryResource::class;

    protected function getActions(): array
    {
        parent::getActions();
        return [
            Action::make('delete')
                ->action(fn() => $this->record->delete())
                ->requiresConfirmation()->color('danger'),
        ];
    }
}
