<?php

namespace App\API\Controllers;

use App\API\Transformers\ContactUsTransformer;
use App\Constants\Attributes;
use App\Models\AboutUs;
use App\Helpers;
use App\Models\ContactUs;
use Dingo\Api\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use VIITech\Helpers\Constants\CastingTypes;
use VIITech\Helpers\GlobalHelpers;

/**
 * Class AboutUsController
 * @package App\API\Controllers
 */
class ContactUsController extends CustomController
{
    public function all(Request $request)
    {
        $all = ContactUs::all();
        return Helpers::returnResponse([
            Attributes::CONTACT_US => AboutUs::returnTransformedItems($all,ContactUsTransformer::class),
        ]);
    }
    public function add(Request $request)
    {
        $first_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FIRST_NAME, null, CastingTypes::STRING);
        $last_name = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::LAST_NAME, null, CastingTypes::STRING);
        $email = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::EMAIL, null, CastingTypes::STRING);
        $message = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::MESSAGE, null, CastingTypes::STRING);
        $array = [$first_name, $last_name, $email, $message];
        foreach ($array as $request) {
            if (is_null($request)) {
                return GlobalHelpers::formattedJSONResponse("Please Fill All Attributes", [], [], Response::HTTP_BAD_REQUEST);
            }
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return GlobalHelpers::formattedJSONResponse("Email Is not correct", [], [], Response::HTTP_BAD_REQUEST);
        }

        $contact_us = ContactUs::createOrUpdate([
            Attributes::FIRST_NAME => $first_name,
            Attributes::LAST_NAME => $last_name,
            Attributes::EMAIL => $email,
            Attributes::MESSAGE => $message
        ]);
        return Helpers::returnResponse([
            Attributes::CONTACT_US => AboutUs::returnTransformedItems($contact_us,ContactUsTransformer::class),
        ]);

    }
}
