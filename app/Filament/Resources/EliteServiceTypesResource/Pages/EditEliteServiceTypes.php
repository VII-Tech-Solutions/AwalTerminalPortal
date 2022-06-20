<?php

namespace App\Filament\Resources\EliteServiceTypesResource\Pages;

use App\Filament\Resources\EliteServiceTypesResource;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditEliteServiceTypes extends EditRecord
{
    protected static string $resource = EliteServiceTypesResource::class;

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
