<?php

namespace App\API\Controllers;

use App\API\Transformers\ContactUsTransformer;
use App\Constants\Attributes;
use App\Constants\CastingTypes;
use App\Helpers;
use App\Models\ContactUs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use VIITech\Helpers\GlobalHelpers;


/**
 * Class ContactUsController
 * @package App\API\Controllers
 */
class ContactUsController extends CustomController
{

    /**
     * List All
     * @return JsonResponse
     */
    public function all()
    {
        $all = ContactUs::all();
        return Helpers::returnResponse([
            Attributes::CONTACT_US => ContactUs::returnTransformedItems($all,ContactUsTransformer::class),
        ]);
    }

    /**
     * Submit Form
     * @return JsonResponse
     */
    public function submitForm()
    {

        // get data
        $first_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FIRST_NAME, null, CastingTypes::STRING);
        $last_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::LAST_NAME, null, CastingTypes::STRING);
        $email = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::EMAIL, null, CastingTypes::STRING);
        $message = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::MESSAGE, null, CastingTypes::STRING);

        // validate data
        $array = [$first_name, $last_name, $email, $message];
        foreach ($array as $request) {
            if (is_null($request)) {
                return Helpers::formattedJSONResponse("Please fill all attributes", [], [], Response::HTTP_BAD_REQUEST);
            }
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return Helpers::formattedJSONResponse("Email is not correct", [], [], Response::HTTP_BAD_REQUEST);
        }

        // save
        $contact_us = ContactUs::createOrUpdate([
            Attributes::FIRST_NAME => $first_name,
            Attributes::LAST_NAME => $last_name,
            Attributes::EMAIL => $email,
            Attributes::MESSAGE => $message
        ]);

        // return response
        if ($contact_us) {


            return Helpers::formattedJSONResponse("Submitted successfully", [
                Attributes::CONTACT_US => ContactUs::returnTransformedItems($contact_us, ContactUsTransformer::class),
            ], null, Response::HTTP_OK);
        }
        return Helpers::formattedJSONResponse("Something went wrong", [], [], Response::HTTP_BAD_REQUEST);
    }
}
