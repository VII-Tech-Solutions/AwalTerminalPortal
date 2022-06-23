<?php

namespace App\Filament\Resources\EliteServicesResource\Pages;

use App\Constants\Attributes;
use App\Constants\ESStatus;
use App\Filament\Resources\EliteServicesResource;
use App\Helpers;
use App\Mail\ESBookingApproveMail;
use App\Mail\ESBookingRejectUpdateMail;
use App\Mail\ESRequestReceivedMail;
use App\Models\Bookers;
use App\Models\EliteServices;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditEliteServices extends EditRecord
{
    protected static string $resource = EliteServicesResource::class;

    protected function callBeforeAndAfterSyncHooks($name, $value, $callback): void
    {
        parent::callBeforeAndAfterSyncHooks($name, $value, $callback);

        if (Str::contains($name, [Attributes::SUBMISSION_STATUS_ID])) {
            $booker = collect($this->data[Attributes::BOOKER])->first();
            $email = $booker[Attributes::EMAIL];
            $name = $booker[Attributes::FIRST_NAME];
            $rejectionReason = $this->data[Attributes::REJECTION_REASON];

            switch ($value) {
                case ESStatus::PENDING_APPROVAL:
                    Helpers::sendMailable(new ESRequestReceivedMail($email, $name, []), $email);
                    break;
                case ESStatus::REJECTED:
                    Helpers::sendMailable(new ESBookingRejectUpdateMail($email, $name, $rejectionReason, []), $email);
                    break;
                case ESStatus::APPROVED:
                    /** @var EliteServices $elite_service */
                    $elite_service = EliteServices::query()->where(Attributes::ID, $this->data[Attributes::ID])->first();
                    $user = Bookers::query()->where(Attributes::ID, $elite_service->id)->first();
                    $link = $elite_service->generatePaymentLink($elite_service->uuid);
                    $amount = $elite_service->total;
                    Helpers::sendMailable(new ESBookingApproveMail($user->email, $user->first_name, [$link, $amount]), $user->email);
                    break;
            }

        }
    }


    protected function getActions(): array
    {
        parent::getActions();
        return [
            Action::make('delete')
                ->action(fn() => $this->record->delete())
                ->requiresConfirmation()->color('danger'),
        ];
    }

}
