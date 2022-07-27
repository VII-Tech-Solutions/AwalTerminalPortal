<?php

namespace App\Filament\Resources\HomepageContentResource\Pages;

use App\Filament\Resources\HomepageContentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomepageContent extends EditRecord
{
    protected static string $resource = HomepageContentResource::class;

    /**
     * @param bool $shouldRegisterNavigation
     */
    public static function setShouldRegisterNavigation(bool $shouldRegisterNavigation): void
    {
        self::$shouldRegisterNavigation = true;

    }
    protected static bool $shouldRegisterNavigation = true;

    protected function getActions(): array
    {
        return [
        ];
    }
}
