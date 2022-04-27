<?php

namespace App\API\Controllers;

use App\API\Transformers\ContactUsTransformer;
use App\API\Transformers\EliteServiceTransformer;
use App\Constants\Attributes;
use App\Constants\FlightType;
use App\Models\AboutUs;
use App\Helpers;
use App\Models\ContactUs;
use App\Models\EliteServices;
use Dingo\Api\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpParser\JsonDecoder;
use VIITech\Helpers\Constants\CastingTypes;
use VIITech\Helpers\GlobalHelpers;

/**
 * Class AboutUsController
 * @package App\API\Controllers
 */
class EliteServiceController extends CustomController
{
    public function all(Request $request)
    {
        $all = EliteServices::all();
        return Helpers::returnResponse([
            'Elite Services' => EliteServices::returnTransformedItems($all,EliteServiceTransformer::class),
        ]);
    }
    public function add(Request $request)
    {
        $flight_type = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FLIGHT_TYPE, null, CastingTypes::STRING);
        $date = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::DATE, null, CastingTypes::STRING);
        $time = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::TIME, null, CastingTypes::STRING);
        $flight_number = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::FLIGHT_NUMBER, null, CastingTypes::STRING);
        $number_of_adults = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NUMBER_OF_ADULTS, null, CastingTypes::STRING);
        $number_of_children = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NUMBER_OF_CHILDREN, null, CastingTypes::STRING);
        $number_of_inftants = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::NUMBER_OF_INFANTS, null, CastingTypes::STRING);
        $passenger = GlobalHelpers::getValueFromHTTPRequest($this->request, Attributes::PASSENGER, null, CastingTypes::STRING);
        $array = ['Flight Type' => $flight_type,'Date' => $date, 'Time' => $time,'Flight Number' => $flight_number,'number of infants' => $number_of_inftants,'number of children' => $number_of_children,
            'number of adults' => $number_of_adults, 'Passenger' => $passenger];
        foreach ($array as $key => $request) {
            if (is_null($request)) {
                return GlobalHelpers::formattedJSONResponse("Attribute ".$key." is Missing", [], [], Response::HTTP_BAD_REQUEST);
            }
        }

            $json = json_encode($passenger);
        $service = EliteServices::createOrUpdate([
            Attributes::FLIGHT_TYPE => $flight_type,
            Attributes::DATE => $date,
            Attributes::TIME => $time,
            Attributes::FLIGHT_NUMBER => $flight_number,
            Attributes::NUMBER_OF_ADULTS => $number_of_adults,
            Attributes::NUMBER_OF_CHILDREN => $number_of_children,
            Attributes::NUMBER_OF_INFANTS => $number_of_inftants,
            Attributes::PASSENGER => $json
        ]);
        if($service){
            return Helpers::returnResponse([
                'Message' => 'Successful',
                'Elite Services' => EliteServices::returnTransformedItems($service,EliteServiceTransformer::class)

            ]);
        }


    }
}
