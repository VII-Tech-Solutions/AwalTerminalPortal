<?php

namespace App\Filament\Resources\GeneralAviationServicesResource\Pages;

use App\Constants\Attributes;
use App\Filament\Resources\GeneralAviationServicesResource;
use App\Helpers;
use App\Mail\ESBookingApproveMail;
use App\Mail\GAServiceBookingAprrovedMail;
use App\Mail\GAServiceBookingRejectMail;
use App\Mail\GAServiceRequestReceivedMail;
use App\Models\Bookers;
use App\Models\EliteServices;
use App\Models\GeneralAviationServices;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditGeneralAviationServices extends EditRecord
{
    protected static string $resource = GeneralAviationServicesResource::class;


    protected function callBeforeAndAfterSyncHooks($name, $value, $callback): void
    {
        parent::callBeforeAndAfterSyncHooks($name, $value, $callback);

        if (Str::contains($name, [Attributes::SUBMISSION_STATUS_ID])) {
            $id = $this->data['id'];
            $general_aviation = GeneralAviationServices::query()->where(Attributes::ID, $id)->first();
            $operator_full_name = $general_aviation->operator_full_name;
            $agent_fullname = $general_aviation->agent_fullname;
            $operator_email = $general_aviation->operator_email;

            switch ($value) {
                case 1:
                    Helpers::sendMailable(new GAServiceRequestReceivedMail($operator_email, $operator_full_name, [$agent_fullname]), $operator_email);
                    break;
                case 2:
                    Helpers::sendMailable(new GAServiceBookingRejectMail($operator_email, $operator_full_name, [$agent_fullname]), $operator_email);
                    break;
                case 3:
                    Helpers::sendMailable(new GAServiceBookingAprrovedMail($operator_email, $operator_full_name, [$agent_fullname]), $operator_email);
                case 4:
            }

        }
    }
}
