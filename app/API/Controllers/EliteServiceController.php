<?php

namespace App\API\Controllers;

use App\API\Transformers\EliteServiceTransformer;
use App\Constants\Attributes;
use App\Constants\FlightType;
use App\Helpers;
use App\Models\EliteServices;
use App\Models\Passengers;
use App\Models\Bookers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use VIITech\Helpers\Constants\CastingTypes;
use VIITech\Helpers\GlobalHelpers;

/**
 * Class EliteServiceController
 * @package App\API\Controllers
 */
class EliteServiceController extends CustomController
{
    /**
     * List All
     * @return JsonResponse
     */
    public function all()
    {
        $all = EliteServices::all();
        return Helpers::returnResponse([
            Attributes::ELITE_SERVICES => EliteServices::returnTransformedItems($all, EliteServiceTransformer::class),
        ]);
    }

    /**
     * Submit Form
     * @return JsonResponse
     */
    public function submitForm()
    {

        // get data
        $flight_type = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FLIGHT_TYPE, null, CastingTypes::INTEGER);
        $date = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::DATE, null, CastingTypes::STRING);
        $time = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::TIME, null, CastingTypes::STRING);
        $flight_number = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FLIGHT_NUMBER, null, CastingTypes::STRING);
        $number_of_adults = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NUMBER_OF_ADULTS, null, CastingTypes::INTEGER);
        $number_of_children = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NUMBER_OF_CHILDREN, null, CastingTypes::INTEGER);
        $number_of_infants = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NUMBER_OF_INFANTS, null, CastingTypes::INTEGER);
        $passengers = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGERS, null, CastingTypes::ARRAY);
        $booker = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::BOOKER, null, CastingTypes::STRING);
        $booker_firstname = GlobalHelpers::getValueFromHTTPRequest($booker, Attributes::FIRST_NAME, null, CastingTypes::STRING);
        $booker_lastname = GlobalHelpers::getValueFromHTTPRequest($booker, Attributes::LAST_NAME, null, CastingTypes::STRING);
        $booker_mobile_number = GlobalHelpers::getValueFromHTTPRequest($booker, Attributes::MOBILE_NUMBER, null, CastingTypes::STRING);
        $booker_comments = GlobalHelpers::getValueFromHTTPRequest($booker, Attributes::COMMENTS, null, CastingTypes::STRING);
        $booker_array = [
            'First name' => $booker_firstname,
            'Last name' => $booker_lastname,
            'Booker mobile number' => $booker_mobile_number
        ];
        $array = [
            'Flight Type' => $flight_type,
            'Date' => $date,
            'Time' => $time,
            'Flight Number' => $flight_number,
            'number of infants' => $number_of_infants,
            'number of children' => $number_of_children,
            'number of adults' => $number_of_adults,
            'Passenger' => $passengers
        ];

        // validate data
        foreach ($array as $key => $request) {
            if (is_null($request)) {
                return Helpers::formattedJSONResponse("Attribute " . $key . " is Missing", [], [], Response::HTTP_BAD_REQUEST);
            }
        }

        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            return Helpers::formattedJSONResponse("Date Format is wrong Ex. 2022-12-29", [], [], Response::HTTP_BAD_REQUEST);
        }

        if (!preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?/", $time)) {
            return Helpers::formattedJSONResponse("Time Format is wrong Ex. 23:59", [], [], Response::HTTP_BAD_REQUEST);
        }

        foreach ($passengers as $subkey => $passenger) {
            $first_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FIRST_NAME, null, CastingTypes::STRING);
            $last_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::LAST_NAME, null, CastingTypes::STRING);
            $gender = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::GENDER, null, CastingTypes::INTEGER);
            $birth_date = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::BIRTH_DATE, null, CastingTypes::STRING);
            $nationality_id = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NATIONALITY_ID, null, CastingTypes::STRING);
            $flight_class = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FLIGHT_CLASS, null, CastingTypes::STRING);

            $passenger_array = ['First name' => $first_name, 'Last name' => $last_name, 'Gender' => $gender, 'Birth date' => $birth_date, 'Nationality id' => $nationality_id, 'Flight class' => $flight_class];

            // validate passenger array
            foreach ($passenger_array as $key => $subkey) {
                if (is_null($passenger)) {
                    return Helpers::formattedJSONResponse("Attribute " . $key . " is Missing", [], [], Response::HTTP_BAD_REQUEST);
                }
            }

        }

        // validate booker array
        foreach ($booker_array as $key => $subkey) {
            if (is_null($booker)) {
                return Helpers::formattedJSONResponse("Attribute " . $key . " is Missing", [], [], Response::HTTP_BAD_REQUEST);
            }
        }

        // validate flight type
        if(empty(FlightType::getKey($flight_type))){
            return Helpers::formattedJSONResponse("Invalid flight type", [], [], Response::HTTP_BAD_REQUEST);
        }

        // save data

        $service = EliteServices::createOrUpdate([
            Attributes::FLIGHT_TYPE => $flight_type,
            Attributes::DATE => $date,
            Attributes::TIME => $time,
            Attributes::FLIGHT_NUMBER => $flight_number,
            Attributes::NUMBER_OF_ADULTS => $number_of_adults,
            Attributes::NUMBER_OF_CHILDREN => $number_of_children,
            Attributes::NUMBER_OF_INFANTS => $number_of_infants,
        ]);

        if(!is_a($service, EliteServices::class)){
            return Helpers::formattedJSONResponse("Something went wrong", [], [], Response::HTTP_BAD_REQUEST);
        }

        $booker_info = Bookers::createOrUpdate([
            Attributes::FIRST_NAME => $booker_firstname,
            Attributes::LAST_NAME => $booker_lastname,
            Attributes::MOBILE_NUMBER => $booker_mobile_number,
            Attributes::COMMENTS => $booker_comments,
            Attributes::SERVICE_ID => $service->id
        ]);

        foreach ($passengers as $subkey => $passenger) {
            $first_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FIRST_NAME, null, CastingTypes::STRING);
            $last_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::LAST_NAME, null, CastingTypes::STRING);
            $gender = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::GENDER, null, CastingTypes::INTEGER);
            $birth_date = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::BIRTH_DATE, null, CastingTypes::STRING);
            $nationality_id = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NATIONALITY_ID, null, CastingTypes::STRING);
            $flight_class = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FLIGHT_CLASS, null, CastingTypes::STRING);
            Passengers::createOrUpdate([
                Attributes::FIRST_NAME => $first_name,
                Attributes::LAST_NAME => $last_name,
                Attributes::GENDER => $gender,
                Attributes::BIRTH_DATE => $birth_date,
                Attributes::NATIONALITY_ID => $nationality_id,
                Attributes::FLIGHT_CLASS => $flight_class,
                Attributes::SERVICE_ID => $service->id
            ]);

        }

        // return response
        if ($service && $booker_info) {
            return Helpers::formattedJSONResponse("Submitted successfully", [
                Attributes::ELITE_SERVICES => EliteServices::returnTransformedItems($service, EliteServiceTransformer::class),
                Attributes::PASSENGERS => $passengers,
                Attributes::BOOKER => $booker
            ], null, Response::HTTP_OK);
        }
        return Helpers::formattedJSONResponse("Something went wrong", [], [], Response::HTTP_BAD_REQUEST);

    }
}
