<?php

namespace App\Filament\Resources\HomepageContentResource\Pages;

use App\Filament\Resources\HomepageContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomepageContent extends EditRecord
{
    protected static string $resource = HomepageContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
