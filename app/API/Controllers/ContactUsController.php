<?php

namespace App\API\Controllers;

use App\Constants\Attributes;
use App\Models\AboutUs;
use App\Helpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AboutUsController
 * @package App\API\Controllers
 */
class ContactUsController extends CustomController
{

    /**
     * List All About Us Items
     *
     * @param Request $request
     * @return JsonResponse
     *
     * * @OA\GET(
     *     path="/api/contact-us",
     *     tags={"Contact Us"},
     *     description="List All Contact Us ",
     *     @OA\Response(response="200", description="About Us Items retrived successfully ", @OA\JsonContent(ref="#/components/schemas/CustomJsonResponse")),
     *     @OA\Response(response="500", description="Internal Server Error", @OA\JsonContent(ref="#/components/schemas/CustomJsonResponse")),
     * )
     */
    public function all(Request $request): JsonResponse
    {
        dd('hello');
        $about_us = AboutUs::active()->orderBy(Attributes::ORDER)->get();

        // return response
        return Helpers::returnResponse([
            Attributes::ABOUT_US => AboutUs::returnTransformedItems($about_us, AboutUsTransformer::class),
        ]);

    }





}
