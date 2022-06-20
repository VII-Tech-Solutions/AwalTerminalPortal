<?php

namespace App\Filament\Resources\GeneralServiceTypesResource\Pages;

use App\Filament\Resources\GeneralServiceTypesResource;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditGeneralServiceTypes extends EditRecord
{
    protected static string $resource = GeneralServiceTypesResource::class;


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
