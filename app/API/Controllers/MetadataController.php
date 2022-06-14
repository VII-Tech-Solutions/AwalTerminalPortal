<?php

namespace App\API\Controllers;

use App\API\Transformers\AirportTransformer;
use App\API\Transformers\CountryTransformer;
use App\API\Transformers\EliteServiceFeaturesTransformer;
use App\API\Transformers\EliteServiceTypesTransformer;
use App\API\Transformers\FormServicesTransformer;
use App\Constants\Attributes;
use App\Helpers;
use App\Models\Airport;
use App\Models\Country;
use App\Models\EliteServiceFeatures;
use App\Models\EliteServiceTypes;
use App\Models\FormServices;
use Illuminate\Http\JsonResponse;

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
        $elite_service_types = EliteServiceTypes::all();
        $elite_service_features = EliteServiceFeatures::all();
        $form_services = FormServices::all();

        // return response
        return Helpers::returnResponse([
            Attributes::AIRPORTS => Airport::returnTransformedItems($airports, AirportTransformer::class),
            Attributes::COUNTRIES => Country::returnTransformedItems($countries, CountryTransformer::class),
            Attributes::ELITE_SERVICES_TYPES => EliteServiceTypes::returnTransformedItems($elite_service_types, EliteServiceTypesTransformer::class),
            Attributes::ELITE_SERVICES_FEATURES => EliteServiceFeatures::returnTransformedItems($elite_service_features, EliteServiceFeaturesTransformer::class),
            Attributes::FORM_SERVICES => EliteServiceFeatures::returnTransformedItems($form_services, FormServicesTransformer::class),
        ]);
    }
}
