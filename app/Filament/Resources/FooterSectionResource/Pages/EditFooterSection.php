<?php

namespace App\Filament\Resources\FooterSectionResource\Pages;

use App\Filament\Resources\FooterSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFooterSection extends EditRecord
{
    protected static string $resource = FooterSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
