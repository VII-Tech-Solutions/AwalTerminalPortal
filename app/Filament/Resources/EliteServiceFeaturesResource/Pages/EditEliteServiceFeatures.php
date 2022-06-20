<?php

namespace App\Filament\Resources\EliteServiceFeaturesResource\Pages;

use App\Filament\Resources\EliteServiceFeaturesResource;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditEliteServiceFeatures extends EditRecord
{
    protected static string $resource = EliteServiceFeaturesResource::class;

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
