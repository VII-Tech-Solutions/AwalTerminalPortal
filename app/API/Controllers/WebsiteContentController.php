<?php

namespace App\API\Controllers;

use App\API\Transformers\ListContactUsContentTransformer;
use App\API\Transformers\ListEliteServicesContentTransformer;
use App\API\Transformers\ListGeneralAviationContentTransformer;
use App\API\Transformers\ListHomepageContentTransformer;
use App\API\Transformers\ListOurStoryContentTransformer;
use App\API\Transformers\ListServicesContentTransformer;
use App\API\Transformers\ListTourTheTerminalContentTransformer;
use App\Constants\Attributes;
use App\Helpers;
use App\Models\ContactUsContent;
use App\Models\EliteServicesContent;
use App\Models\GeneralAviationContent;
use App\Models\HomepageContent;
use App\Models\OurStoryContent;
use App\Models\ServicesContent;
use App\Models\TourTheTerminalContent;
use Illuminate\Http\JsonResponse;

class WebsiteContentController extends CustomController
{

    /**
     * homepageContent
     * @return JsonResponse
     */
    public function homepageContent() {
        // get data
        $homepage_content = HomepageContent::all();

        // return response
        return Helpers::returnResponse([
            Attributes::HOMEPAGE_CONTENT => HomepageContent::returnTransformedItems($homepage_content, ListHomepageContentTransformer::class),
        ]);
    }

    /**
     * tourTheTerminalContent
     * @return JsonResponse
     */
    public function tourTheTerminalContent() {
        // get data
        $tourTheTerminalContent = TourTheTerminalContent::all();

        // return response
        return Helpers::returnResponse([
            Attributes::TOUR_THE_TERMINAL_CONTENT => TourTheTerminalContent::returnTransformedItems($tourTheTerminalContent, ListTourTheTerminalContentTransformer::class),
        ]);
    }

    /**
     * ourStoryContent
     * @return JsonResponse
     */
    public function ourStoryContent() {
        // get data
        $ourStoryContent = OurStoryContent::all();

        // return response
        return Helpers::returnResponse([
            Attributes::OUR_STORY_CONTENT => OurStoryContent::returnTransformedItems($ourStoryContent, ListOurStoryContentTransformer::class),
        ]);
    }

    /**
     * servicesContent
     * @return JsonResponse
     */
    public function servicesContent() {
        // get data
        $servicesContent = ServicesContent::all();

        // return response
        return Helpers::returnResponse([
            Attributes::SERVICES_CONTENT => ServicesContent::returnTransformedItems($servicesContent, ListServicesContentTransformer::class),
        ]);
    }

    /**
     * eliteServicesContent
     * @return JsonResponse
     */
    public function eliteServicesContent() {
        // get data
        $eliteServicesContent = EliteServicesContent::all();

        // return response
        return Helpers::returnResponse([
            Attributes::ELITE_SERVICES_CONTENT => EliteServicesContent::returnTransformedItems($eliteServicesContent, ListEliteServicesContentTransformer::class),
        ]);
    }

    /**
     * generalAviationContent
     * @return JsonResponse
     */
    public function generalAviationContent() {
        // get data
        $generalAviationContent = GeneralAviationContent::all();

        // return response
        return Helpers::returnResponse([
            Attributes::GENERAL_AVIATION_CONTENT => GeneralAviationContent::returnTransformedItems($generalAviationContent, ListGeneralAviationContentTransformer::class),
        ]);
    }

    /**
     * contactUsContent
     * @return JsonResponse
     */
    public function contactUsContent() {
        // get data
        $contactUsContent = ContactUsContent::all();

        // return response
        return Helpers::returnResponse([
            Attributes::CONTACT_US_CONTENT => ContactUsContent::returnTransformedItems($contactUsContent, ListContactUsContentTransformer::class),
        ]);
    }
}
