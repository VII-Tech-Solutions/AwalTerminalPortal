<?php

namespace App\Filament\Resources\FirstMainSectionResource\Pages;

use App\Filament\Resources\FirstMainSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFirstMainSection extends EditRecord
{
    protected static string $resource = FirstMainSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
