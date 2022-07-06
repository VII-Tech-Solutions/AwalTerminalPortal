<?php

namespace App\Filament\Resources\DashboardResource\Pages;

use App\Filament\Resources\HeaderSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDashboards extends ListRecords
{
    protected static string $resource = HeaderSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
