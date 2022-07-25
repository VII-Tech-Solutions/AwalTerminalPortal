<?php

namespace App\Filament\Resources\ContactUsResource\Pages;

use App\Filament\Resources\ContactUsResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Pages\Actions\Action;

class ViewContactUs extends ViewRecord
{
    protected static string $resource = ContactUsResource::class;
    protected static ?string $navigationLabel = "Contact Us Submissions";


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

