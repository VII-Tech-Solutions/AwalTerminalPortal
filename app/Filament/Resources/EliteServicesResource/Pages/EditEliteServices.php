<?php

namespace App\Filament\Resources\EliteServicesResource\Pages;

use App\Constants\Attributes;
use App\Filament\Resources\EliteServicesResource;
use App\Models\EliteServices;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditEliteServices extends EditRecord
{
    protected static string $resource = EliteServicesResource::class;

    protected function callBeforeAndAfterSyncHooks($name, $value, $callback): void
    {
        parent::callBeforeAndAfterSyncHooks($name, $value, $callback);

        if (Str::contains($name, [Attributes::SUBMISSION_STATUS_ID])) {
            $id = $this->data[Attributes::ID];
            $booker = collect($this->data[Attributes::BOOKER])->first();
            $email = $booker[Attributes::EMAIL];
            $name = $booker[Attributes::FIRST_NAME];
            $rejection_reason = $this->data[Attributes::REJECTION_REASON];
            EliteServices::changeStatus($id, $name, $email, $value, $rejection_reason);
        }
    }


    protected function getActions(): array
    {
        parent::getActions();
        return [

        ];
    }

}
