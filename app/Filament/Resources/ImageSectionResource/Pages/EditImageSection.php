<?php

namespace App\Filament\Resources\ImageSectionResource\Pages;

use App\Filament\Resources\ImageSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImageSection extends EditRecord
{
    protected static string $resource = ImageSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
