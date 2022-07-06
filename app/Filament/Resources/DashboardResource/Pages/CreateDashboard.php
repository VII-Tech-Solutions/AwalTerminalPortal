<?php

namespace App\Filament\Resources\DashboardResource\Pages;

use App\Filament\Resources\HeaderSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDashboard extends CreateRecord
{
    protected static string $resource = HeaderSectionResource::class;
}
