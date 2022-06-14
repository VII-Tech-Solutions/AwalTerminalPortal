<?php

namespace App\API\Controllers;

use App\API\Transformers\AttachmentTransformer;
use App\API\Transformers\GeneralAviationTransformer;
use App\Constants\Attributes;
use App\Helpers;
use App\Models\Attachment;
use App\Models\GeneralAviationSelectedServices;
use App\Models\GeneralAviationServices;
use Dingo\Api\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use VIITech\Helpers\Constants\CastingTypes;
use VIITech\Helpers\GlobalHelpers;

/**
 * Class GeneralAviationFormController
 * @package App\API\Controllers
 */
class GeneralAviationFormController extends CustomController
{

    /**
     * List All
     * @return JsonResponse
     */
    public function all()
    {
        $all = GeneralAviationServices::all();
        return Helpers::returnResponse([
            Attributes::GENERAL_SERVICES => GeneralAviationServices::returnTransformedItems($all, GeneralAviationTransformer::class),
        ]);
    }

    /**
     * Submit Form
     * @return JsonResponse
     */
    public function submitForm()
    {

        // validate data
        $aircraft_type = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::AIRCRAFT_TYPE, null, CastingTypes::INTEGER);
        $registration_number = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::REGISTRATION_NUMBER, null, CastingTypes::INTEGER);
        $mtow = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::MTOW, null, CastingTypes::STRING);
        $lead_passenger_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::LEAD_PASSENGER_NAME, null, CastingTypes::STRING);
        $landing_purpose = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::LANDING_PURPOSE, null, CastingTypes::INTEGER);
        $arrival_call_sign = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::ARRIVAL_CALL_SIGN, null, CastingTypes::STRING);
        $arriving_from_airport = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::ARRIVING_FROM_AIRPORT, null, CastingTypes::INTEGER);
        $estimated_time_of_arrival = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::ESTIMATED_TIME_OF_ARRIVAL, null, CastingTypes::STRING);
        $arrival_date = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::ARRIVAL_DATE, null, CastingTypes::STRING);
        $arrival_flight_nature = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::ARRIVAL_FLIGHT_NATURE, null, CastingTypes::STRING);
        $arrival_passenger_count = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::ARRIVAL_PASSENGER_COUNT, null, CastingTypes::INTEGER);
        $departure_call_sign = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::DEPARTURE_CALL_SIGN, null, CastingTypes::STRING);
        $departure_to_airport = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::DEPARTURE_TO_AIRPORT, null, CastingTypes::INTEGER);
        $estimated_time_of_departure = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::ESTIMATED_TIME_OF_DEPARTURE, null, CastingTypes::STRING);
        $departure_date = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::DEPARTURE_DATE, null, CastingTypes::STRING);
        $departure_flight_nature = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::DEPARTURE_FLIGHT_NATURE, null, CastingTypes::STRING);
        $departure_passenger_count = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::DEPARTURE_PASSENGER_COUNT, null, CastingTypes::INTEGER);
        $operator_full_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::OPERATOR_FULL_NAME, null, CastingTypes::STRING);
        $operator_country = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::OPERATOR_COUNTRY, null, CastingTypes::STRING);
        $operator_tel_number = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::OPERATOR_TEL_NUMBER, null, CastingTypes::STRING);
        $operator_email = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::OPERATOR_EMAIL, null, CastingTypes::STRING);
        $operator_address = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::OPERATOR_ADDRESS, null, CastingTypes::STRING);
        $operator_billing_address = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::OPERATOR_BILLING_ADDRESS, null, CastingTypes::STRING);
        $is_using_agent = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::IS_USING_AGENT, null, CastingTypes::BOOLEAN);
        $agent_fullname = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::AGENT_FULLNAME, null, CastingTypes::STRING);
        $agent_country = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::AGENT_COUNTRY, null, CastingTypes::STRING);
        $agent_phoneNumber = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::AGENT_PHONENUMBER, null, CastingTypes::STRING);
        $agent_email = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::AGENT_EMAIL, null, CastingTypes::STRING);
        $agent_address = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::AGENT_ADDRESS, null, CastingTypes::STRING);
        $agent_billing_address = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::AGENT_BILLING_ADDRESS, null, CastingTypes::STRING);
        $services = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::SERVICES, null, CastingTypes::ARRAY);
        $transport_hotel_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::TRANSPORT_HOTEL_NAME, null, CastingTypes::STRING);
        $transport_time = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::TRANSPORT_TIME, null, CastingTypes::STRING);
        $remarks = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::REMARKS, null, CastingTypes::STRING);
        $attachments = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::ATTACHMENTS, [], CastingTypes::ARRAY);

        // validate data
        $array = [
            'Air Craft Type' => $aircraft_type,
            'Registration number' => $registration_number,
            'MTOW' => $mtow,
            'Lead passenger name' => $lead_passenger_name,
            'Landing purpose' => $landing_purpose,
            'Arrival call sign' => $arrival_call_sign,
            'Arriving from airport' => $arriving_from_airport,
            'Estimated time of arrival' => $estimated_time_of_arrival,
            'Arrival date' => $arrival_date,
            'Arrival flight nature' => $arrival_flight_nature,
            'Arrival passenger count' => $arrival_passenger_count,
            'Departure call sign' => $departure_call_sign,
            'Departure to airport' => $departure_to_airport,
            'Estimated time of departure' => $estimated_time_of_departure,
            'Departure date' => $departure_date,
            'Departure flight nature' => $departure_flight_nature,
            'Departure passenger count' => $departure_passenger_count,
            'Operator full name' => $operator_full_name,
            'Operator country' => $operator_country,
            'Operator tel number' => $operator_tel_number,
            'Operator email' => $operator_email,
            'Operator address' => $operator_address,
            'Operator billing address' => $operator_billing_address,
            'Is using agent' => $is_using_agent,
            'Agent fullname' => $agent_fullname,
            'Agent country' => $agent_country,
            'Agent phone number' => $agent_phoneNumber,
            'Agent email' => $agent_email,
            'Agent address' => $agent_address,
            'Agent billing address' => $agent_billing_address,
            'Services' => $services,
            'Transport hotel name' => $transport_hotel_name,
            'Transport time' => $transport_time,
            'Remarks' => $remarks
        ];


        foreach ($array as $key => $request) {
            if (is_null($request)) {
                return Helpers::formattedJSONResponse("Attribute " . $key . " is Missing", [], [], Response::HTTP_BAD_REQUEST);
            }
        }

        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $arrival_date)) {
            return Helpers::formattedJSONResponse("Date Format is wrong Ex. 2022-12-29", [], [], Response::HTTP_BAD_REQUEST);
        }

        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $departure_date)) {
            return Helpers::formattedJSONResponse("Date Format is wrong Ex. 2022-12-29", [], [], Response::HTTP_BAD_REQUEST);
        }

        if (!preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?/", $estimated_time_of_arrival)) {
            return Helpers::formattedJSONResponse("Time Format is wrong Ex. 23:59", [], [], Response::HTTP_BAD_REQUEST);
        }

        if (!preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?/", $estimated_time_of_departure)) {
            return Helpers::formattedJSONResponse("Time Format is wrong Ex. 23:59", [], [], Response::HTTP_BAD_REQUEST);
        }

        // save data

        $general_service = GeneralAviationServices::createOrUpdate([
            Attributes::AIRCRAFT_TYPE => $aircraft_type,
            Attributes::REGISTRATION_NUMBER => $registration_number,
            Attributes::MTOW => $mtow,
            Attributes::LEAD_PASSENGER_NAME => $lead_passenger_name,
            Attributes::LANDING_PURPOSE => $landing_purpose,
            Attributes::ARRIVAL_CALL_SIGN => $arrival_call_sign,
            Attributes::ARRIVING_FROM_AIRPORT => $arriving_from_airport,
            Attributes::ESTIMATED_TIME_OF_ARRIVAL => $estimated_time_of_arrival,
            Attributes::ARRIVAL_DATE => $arrival_date,
            Attributes::ARRIVAL_FLIGHT_NATURE => $arrival_flight_nature,
            Attributes::ARRIVAL_PASSENGER_COUNT => $arrival_passenger_count,
            Attributes::DEPARTURE_CALL_SIGN => $departure_call_sign,
            Attributes::DEPARTURE_TO_AIRPORT => $departure_to_airport,
            Attributes::ESTIMATED_TIME_OF_DEPARTURE => $estimated_time_of_departure,
            Attributes::DEPARTURE_DATE => $departure_date,
            Attributes::DEPARTURE_FLIGHT_NATURE => $departure_flight_nature,
            Attributes::DEPARTURE_PASSENGER_COUNT => $departure_passenger_count,
            Attributes::OPERATOR_FULL_NAME => $operator_full_name,
            Attributes::OPERATOR_COUNTRY => $operator_country,
            Attributes::OPERATOR_TEL_NUMBER => $operator_tel_number,
            Attributes::OPERATOR_EMAIL => $operator_email,
            Attributes::OPERATOR_ADDRESS => $operator_address,
            Attributes::OPERATOR_BILLING_ADDRESS => $operator_billing_address,
            Attributes::IS_USING_AGENT => $is_using_agent,
            Attributes::AGENT_FULLNAME => $agent_fullname,
            Attributes::AGENT_COUNTRY => $agent_country,
            Attributes::AGENT_PHONENUMBER => $agent_phoneNumber,
            Attributes::AGENT_ADDRESS => $agent_address,
            Attributes::AGENT_BILLING_ADDRESS => $agent_billing_address,
            Attributes::TRANSPORT_HOTEL_NAME => $transport_hotel_name,
            Attributes::TRANSPORT_TIME => $transport_time,
            Attributes::REMARKS => $remarks,
        ]);

        if(!is_null($services) && $general_service){
            foreach ($services as $service ){
                GeneralAviationSelectedServices::createOrUpdate([
                    Attributes::GENERAL_AVIATION_ID => $general_service->id,
                    Attributes::SERVICE_ID => $service
                ]);
            }
        }

        // return response
        if ($general_service) {

            // Adding attachments to the form
            if(!is_null($attachments)){
                $attachments = Attachment::find($attachments);
                foreach ($attachments as $attachment ){
                    $attachment->form_id = $general_service->id;
                    $attachment->save();
                }
            }

            $attachments = $general_service->attachments()->get();

            // return success response
            return Helpers::formattedJSONResponse("Submitted successfully", [
                Attributes::GENERAL_SERVICES => GeneralAviationServices::returnTransformedItems($general_service, GeneralAviationTransformer::class),
                Attributes::ATTACHMENTS => Attachment::returnTransformedItems($attachments, AttachmentTransformer::class),
            ], null, Response::HTTP_OK);
        }
        return Helpers::formattedJSONResponse("Something went wrong", [], [], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Upload Media
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadMedia(Request $request)
    {
        $attachments = collect();

        $files = $request->allFiles();
        foreach ($files as $key => $file) {

            /** @var UploadedFile  $file */
            $upload_result = Helpers::storeFile(null, null, null, $file, true, false);

            $attachment = Attachment::createOrUpdate([
                Attributes::PATH => $upload_result,
            ]);
            if (is_a($attachment, Attachment::class)) {
                $attachments->put($key, $attachment);
            }
        }

        // return response

        return Helpers::formattedJSONResponse("Attachments Uploaded successfully", [
            Attributes::ATTACHMENTS => Attachment::returnTransformedItems($attachments, AttachmentTransformer::class),
        ], null, Response::HTTP_OK);


    }
}
