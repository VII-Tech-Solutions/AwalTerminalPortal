<?php

namespace App\Filament\Resources\GeneralAviationServicesResource\Pages;

use App\Constants\Attributes;
use App\Filament\Resources\GeneralAviationServicesResource;
use App\Helpers;
use App\Mail\GAServiceBookingAprrovedMail;
use App\Mail\GAServiceBookingRejectMail;
use App\Mail\GAServiceRequestReceivedMail;
use App\Models\Airport;
use App\Models\Country;
use App\Models\FormServices;
use App\Models\GAServices;
use App\Models\GeneralAviationServices;
use Filament\Pages\Actions\Action;
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
            $agent_fullName = $general_aviation->agent_fullname;
            $operator_email = $general_aviation->operator_email;
            $rejectionReason = $general_aviation->rejection_reason;
            $aircraft_type = $general_aviation->aircraft_type;
            $registration_number = $general_aviation->registration_number;
            $mtow = $general_aviation->mtow;
            $lead_passenger_name = $general_aviation->lead_passenger_name;
            $landing_purpose = $general_aviation->landing_purpose;
            $arrival_call_sign = $general_aviation->arrival_call_sign;
            $arriving_from_airport = $general_aviation->arriving_from_airport;
            $eta = $general_aviation->estimated_time_of_arrival;
            $arrival_date = $general_aviation->arrival_date;
            $arrival_flight_nature = $general_aviation->arrival_flight_nature;
            $arrival_passenger_count = $general_aviation->arrival_passenger_count;
            $departure_call_sign = $general_aviation->departure_call_sign;
            $departure_to_airport = $general_aviation->departure_to_airport;
            $etd = $general_aviation->estimated_time_of_departure;
            $departure_date = $general_aviation->departure_date;
            $departure_flight_nature = $general_aviation->departure_flight_nature;
            $departure_passenger_count = $general_aviation->departure_passenger_count;
            $operator_country = $general_aviation->operator_country;
            $operator_tel_number = $general_aviation->operator_tel_number;
            $operator_address = $general_aviation->operator_address;
            $operator_billing_address = $general_aviation->operator_billing_address;
            $is_using_agent = $general_aviation->is_using_agent;
            $agent_country = $general_aviation->agent_country;
            $agent_email = $general_aviation->agent_email;
            $agent_phoneNumber = $general_aviation->agent_phonenumber;
            $agent_address = $general_aviation->agent_address;
            $agent_billing_address = $general_aviation->agent_billing_address;
            $services = $general_aviation->services;

            $arriving_from_airport_name = Airport::where(Attributes::ID, $arriving_from_airport)->first();
            $departure_to_airport_name = Airport::where(Attributes::ID, $departure_to_airport)->first();

            $operator_country_name=  Country::where(Attributes::ID, $operator_country)->first();
            $agent_country_name=  Country::where(Attributes::ID, $agent_country)->first();


//            if (!is_null($services)) {
//                foreach ($services as $key => $service) {
//                    GAServices::createOrUpdate([
//                        Attributes::GENERAL_AVIATION_ID => $general_service->id,
//                        Attributes::SERVICE_ID => $service,
//                    ]);
//                    $service_name=  FormServices::where(Attributes::ID, $service)->first();
////                    $services[$key]=$service_name;
////                $this->$service_name = [ $key => $service ];
//
////                $service_name[$key] = FormServices::where(Attributes::ID, $service)->first();
//
//                }
//            }
            switch ($value) {
                case 1:
                    Helpers::sendMailable(new GAServiceRequestReceivedMail($operator_email, $operator_full_name, [$agent_fullName]), $operator_email);
                    break;
                case 2:
                    Helpers::sendMailable(new GAServiceBookingRejectMail($operator_email, $operator_full_name, $rejectionReason, [$agent_fullName]), $operator_email);
                    break;
                case 3:
                    Helpers::sendMailable(new GAServiceBookingAprrovedMail($operator_email, $operator_full_name, [$agent_fullName, $aircraft_type, $registration_number, $mtow, $lead_passenger_name, $landing_purpose, $arrival_call_sign, $arriving_from_airport_name, $eta,
                        $arrival_date, $arrival_flight_nature, $arrival_passenger_count, $departure_call_sign, $departure_to_airport_name, $etd, $departure_date, $departure_flight_nature, $departure_passenger_count, $operator_country_name, $operator_tel_number, $operator_address,
                        $operator_billing_address, $is_using_agent, $agent_country_name, $agent_email, $agent_phoneNumber, $agent_address, $agent_billing_address, $services]), $operator_email);
                case 4:
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
