<?php

namespace App\Filament\Resources\ContactUsResource\Pages;

use App\Filament\Resources\ContactUsResource;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListContactUs extends ListRecords
{
    protected static string $resource = ContactUsResource::class;

    protected static ?string $navigationLabel = "Contact Us Submissions";


    protected function getActions(): array
    {
        parent::getActions();
        return [
//            Action::make('delete')
//                ->action(fn() => $this->record->delete())
//                ->requiresConfirmation()->color('danger'),
        ];
    }


}
