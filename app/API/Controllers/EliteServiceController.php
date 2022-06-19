<?php

namespace App\API\Controllers;

use App\API\Transformers\EliteServiceTransformer;
use App\Constants\AdminUserType;
use App\Constants\Attributes;
use App\Constants\FlightType;
use App\Helpers;
use App\Mail\ESNewBookingMail;
use App\Mail\ESRequestReceivedMail;
use App\Models\Bookers;
use App\Models\EliteServices;
use App\Models\Passengers;
use App\Models\User;
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
     * Get One
     * @return JsonResponse
     */
    public function getOne($uuid)
    {
        // get elite service
        $elite_services = EliteServices::where(Attributes::UUID, $uuid)->get();

        // get passengers
        $passengers = $elite_services->map->passengers;
        $passengers = $passengers->flatten()->unique(Attributes::ID)->values();

        // get booker
        $booker = $elite_services->map->booker;
        $booker = $booker->flatten()->unique(Attributes::ID)->values();

        // return response
        return Helpers::returnResponse([
            Attributes::ELITE_SERVICES => EliteServices::returnTransformedItems($elite_services, EliteServiceTransformer::class),
            Attributes::PASSENGERS => $passengers,
            Attributes::BOOKER => $booker
        ]);
    }

    /**
     * Submit Form
     * @return JsonResponse
     */
    public function submitForm()
    {

        // get data
        $date = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::DATE, null, CastingTypes::STRING);
        $time = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::TIME, null, CastingTypes::STRING);
        $service_id = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::SERVICE_ID, null, CastingTypes::INTEGER);
        $is_arrival_flight = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::IS_ARRIVAL_FLIGHT, null, CastingTypes::INTEGER);
        $airport_id = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::AIRPORT_ID, null, CastingTypes::INTEGER);
        $flight_number = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FLIGHT_NUMBER, null, CastingTypes::STRING);
        $number_of_adults = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NUMBER_OF_ADULTS, null, CastingTypes::INTEGER);
        $number_of_children = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NUMBER_OF_CHILDREN, null, CastingTypes::INTEGER);
        $number_of_infants = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NUMBER_OF_INFANTS, null, CastingTypes::INTEGER);
        $passengers = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGERS, null, CastingTypes::ARRAY);
        $booker = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::BOOKER, null, CastingTypes::STRING);
        $booker_firstname = GlobalHelpers::getValueFromHTTPRequest($booker, Attributes::FIRST_NAME, null, CastingTypes::STRING);
        $booker_lastname = GlobalHelpers::getValueFromHTTPRequest($booker, Attributes::LAST_NAME, null, CastingTypes::STRING);
        $booker_mobile_number = GlobalHelpers::getValueFromHTTPRequest($booker, Attributes::MOBILE_NUMBER, null, CastingTypes::STRING);
        $booker_email = GlobalHelpers::getValueFromHTTPRequest($booker, Attributes::EMAIL, null, CastingTypes::STRING);
        $booker_comments = GlobalHelpers::getValueFromHTTPRequest($booker, Attributes::COMMENTS, null, CastingTypes::STRING);
        $booker_array = [
            'First name' => $booker_firstname,
            'Last name' => $booker_lastname,
            'Booker mobile number' => $booker_mobile_number,
            'Booker email' => $booker_email,
        ];

        $array = [
            'Date' => $date,
            'Time' => $time,
            'Is arrival flight' => $is_arrival_flight,
            'Flight Number' => $flight_number,
            'Airport ID' => $airport_id,
            'Service ID' => $service_id,
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

        // save data

        $service = EliteServices::createOrUpdate([
            Attributes::SERVICE_ID => $service_id,
            Attributes::IS_ARRIVAL_FLIGHT => $is_arrival_flight,
            Attributes::AIRPORT_ID => $airport_id,
            Attributes::DATE => $date,
            Attributes::TIME => $time,
            Attributes::SUBMISSION_STATUS_ID => 1,
            Attributes::FLIGHT_NUMBER => $flight_number,
            Attributes::NUMBER_OF_ADULTS => $number_of_adults,
            Attributes::NUMBER_OF_CHILDREN => $number_of_children,
            Attributes::NUMBER_OF_INFANTS => $number_of_infants,
        ]);

        if (!is_a($service, EliteServices::class)) {
            return Helpers::formattedJSONResponse("Something went wrong", [], [], Response::HTTP_BAD_REQUEST);
        }

        $booker_info = Bookers::createOrUpdate([
            Attributes::FIRST_NAME => $booker_firstname,
            Attributes::LAST_NAME => $booker_lastname,
            Attributes::MOBILE_NUMBER => $booker_mobile_number,
            Attributes::EMAIL => $booker_email,
            Attributes::COMMENTS => $booker_comments,
            Attributes::SERVICE_ID => $service->id
        ]);

        if (!is_null($passengers)) {
            foreach ($passengers as $passenger) {
                $first_name = GlobalHelpers::getValueFromHTTPRequest($passenger, Attributes::FIRST_NAME, null, CastingTypes::STRING);
                $last_name = GlobalHelpers::getValueFromHTTPRequest($passenger, Attributes::LAST_NAME, null, CastingTypes::STRING);
                $gender = GlobalHelpers::getValueFromHTTPRequest($passenger, Attributes::GENDER, null, CastingTypes::INTEGER);
                $birth_date = GlobalHelpers::getValueFromHTTPRequest($passenger, Attributes::BIRTH_DATE, null, CastingTypes::STRING);
                $nationality_id = GlobalHelpers::getValueFromHTTPRequest($passenger, Attributes::NATIONALITY_ID, null, CastingTypes::STRING);
                $flight_class = GlobalHelpers::getValueFromHTTPRequest($passenger, Attributes::FLIGHT_CLASS, null, CastingTypes::STRING);
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

        }

        // return response
        if ($service && $booker_info) {

            // send email to admin
            $admin_users = User::where(Attributes::USER_TYPE, AdminUserType::ELITE_ONLY)->orWhere(Attributes::USER_TYPE, AdminUserType::SUPER_ADMIN)->get();

            foreach($admin_users as $admin_user){
                Helpers::sendMailable(new ESNewBookingMail([]),$admin_user->email);
            }

            // send email to customer
            Helpers::sendMailable(new ESRequestReceivedMail($booker_email, "$booker_firstname $booker_lastname", []), $booker_email);

            // return success
            return Helpers::formattedJSONResponse("Submitted successfully", [
                Attributes::ELITE_SERVICES => EliteServices::returnTransformedItems($service, EliteServiceTransformer::class),
                Attributes::PASSENGERS => $passengers,
                Attributes::BOOKER => $booker
            ], null, Response::HTTP_OK);
        }
        return Helpers::formattedJSONResponse("Something went wrong", [], [], Response::HTTP_BAD_REQUEST);

    }
}
