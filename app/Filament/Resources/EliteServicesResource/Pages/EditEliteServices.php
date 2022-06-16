<?php

namespace App\Filament\Resources\EliteServicesResource\Pages;

use App\Constants\Attributes;
use App\Filament\Resources\EliteServicesResource;
use App\Helpers;
use App\Mail\ESBookingApproveMail;
use App\Mail\ESBookingRejectUpdateMail;
use App\Mail\ESRequestReceivedMail;
use App\Models\Bookers;
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
            $email = $this->data['booker']['record-1']['email'];
            $name = $this->data['booker']['record-1']['first_name'];

            switch ($value) {
                case 1:
                    Helpers::sendMailable(new ESRequestReceivedMail($email, $name, []), $email);
                    break;
                case 2:
                    Helpers::sendMailable(new ESBookingRejectUpdateMail($email, $name, []), $email);
                    break;
                case 3:
                    $elite_service = EliteServices::query()->where(Attributes::ID, $this->data['id'])->first();
                    $user = Bookers::query()->where(Attributes::ID, $elite_service->id)->first();
                    $link = $elite_service->generatePaymentLink($elite_service->uuid);
                    Helpers::sendMailable(new ESBookingApproveMail($user->email, $user->first_name, [$link]), $user->email);                    break;
                case 4:
            }

        }
    }
}
