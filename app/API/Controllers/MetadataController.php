<?php

namespace App\API\Controllers;

use App\API\Transformers\AirportTransformer;
use App\API\Transformers\CountryTransformer;
use App\Constants\Attributes;
use App\Helpers;
use App\Models\Country;
use App\Models\Airport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class MetadataController
 * @package App\API\Controllers
 */
class MetadataController extends CustomController
{

    /**
     * List All
     * @return JsonResponse
     */
    public function all()
    {

        // get metadata
        $countries = Country::all();
        $airports = Airport::all();

        // return response
        return Helpers::returnResponse([
            Attributes::AIRPORTS => Airport::returnTransformedItems($airports, AirportTransformer::class),
            Attributes::COUNTRIES => Country::returnTransformedItems($countries, CountryTransformer::class),
        ]);
    }
}
