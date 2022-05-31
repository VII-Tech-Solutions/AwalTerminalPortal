<?php

namespace App\API\Controllers;

use App\API\Transformers\EliteServiceTransformer;
use App\Constants\Attributes;
use App\Helpers;
use App\Models\EliteServices;
use Dingo\Api\Http\Response;
use Illuminate\Http\Request;
use VIITech\Helpers\Constants\CastingTypes;
use VIITech\Helpers\GlobalHelpers;

/**
 * Class GeneralAviationFormController
 * @package App\API\Controllers
 */
class GeneralAviationFormController extends CustomController
{
    public function submitForm(Request $request)
    {

        $aircraft_type = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FLIGHT_TYPE, null, CastingTypes::INTEGER);
        $registration_number = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::DATE, null, CastingTypes::STRING);
        $mtow = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::TIME, null, CastingTypes::STRING);
        $lead_passenger_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FLIGHT_NUMBER, null, CastingTypes::STRING);
        $landing_purpose = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NUMBER_OF_ADULTS, null, CastingTypes::INTEGER);
        $arrival_call_sign = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NUMBER_OF_CHILDREN, null, CastingTypes::INTEGER);
        $arriving_from_airport = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NUMBER_OF_INFANTS, null, CastingTypes::INTEGER);
        $estimated_time_of_arrival = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $arrival_date = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $arrival_flight_nature = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $arrival_passenger_count = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $departure_call_sign = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $departure_to_airport = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $estimated_time_of_departure = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $departure_date = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $departure_flight_nature = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $departure_passenger_count = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $operator_full_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $operator_country = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $operator_tel_number = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $operator_email = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $operator_address = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $operator_billing_address = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $is_using_agent = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $agent_fullname = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $agent_country = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $agent_phoneNumber = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $agent_email = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $agent_address = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $agent_billing_address = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $services = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $transport_hotel_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $transport_time = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $remarks = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);

        $array = ['Air Craft Type' => $aircraft_type,'Registration number' => $registration_number, 'MTOW' => $mtow,'Lead passenger name' => $lead_passenger_name,'Landing purpose' => $landing_purpose,'Arrival call sign' => $arrival_call_sign,
            'Arriving from airport' => $arriving_from_airport, 'Estimated time of arrival' => $estimated_time_of_arrival, 'Arrival date' => $arrival_date, 'Arrival flight nature' => $arrival_flight_nature, 'Arrival passenger count' => $arrival_passenger_count,
            'Departure call sign' => $departure_call_sign, 'Departure to airport' => $departure_to_airport, 'Estimated time of departure' => $estimated_time_of_departure, 'Departure date' => $departure_date, 'Departure flight nature' => $departure_flight_nature,
            'Departure passenger count' => $departure_passenger_count, 'Operator full name' => $operator_full_name,'Operator country' => $operator_country, 'Operator tel number' => $operator_tel_number, 'Operator email' => $operator_email,'Operator address'=>$operator_address,
            'Operator billing address'=>$operator_billing_address,'Is using agent' => $is_using_agent, 'Agent fullname' => $agent_fullname, 'Agent country' => $agent_country, 'Agent phone number' => $agent_phoneNumber, 'Agent email' => $agent_email, 'Agent address' => $agent_address,
            'Agent address' => $agent_address, 'Agent billing address' => $agent_billing_address, 'Services' => $services, 'Transport hotel name' => $transport_hotel_name, 'Transport time' => $transport_time, 'Remarks' => $remarks ];

        foreach ($array as $key => $request) {
            if (is_null($request)) {
//                return GlobalHelpers::formattedJSONResponse("Attribute ".$key." is Missing", [], [], Response::HTTP_BAD_REQUEST);
            }
        }

//        return GlobalHelpers::formattedJSONResponse("Something went wrong", [], [], Response::HTTP_BAD_REQUEST);
        // return error response
        return GlobalHelpers::formattedJSONResponse("Successful", null, null,  200);
    }

    public function uploadMedia(Request $request)
    {
        return GlobalHelpers::formattedJSONResponse("Successful", null, null,  200);
    }
}
