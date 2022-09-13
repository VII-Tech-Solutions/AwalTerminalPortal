<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*******************************
 * API
 *******************************/
/** @var Router $api */

use Dingo\Api\Routing\Router;
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->get('/', function () {
        return ['status' => true];
    });
    $api->group(['namespace' => 'App\API\Controllers'], function () use ($api) {

        /*******************************
         * Forms
         *******************************/
        $api->get('/calculate-price', 'EliteServiceController@calculatePrice');
        $api->post('/general-aviation', 'GeneralAviationFormController@submitForm');
        $api->post('/general-aviation/media', 'GeneralAviationFormController@uploadMedia');
        $api->post('/contact-us', 'ContactUsController@submitForm');
        $api->post('/elite-service', 'EliteServiceController@submitForm');
        $api->get('/elite-service/{uuid}', 'EliteServiceController@getOne');


        /*******************************
         * Website content
         *******************************/
        $api->get('/elite-service/all', 'EliteServiceController@all');
        $api->get('/metadata', 'MetadataController@all');
        $api->get('/homepage-content', 'WebsiteContentController@homepageContent');
        $api->get('/tour-the-terminal-content', 'WebsiteContentController@tourTheTerminalContent');
        $api->get('/our-story-content', 'WebsiteContentController@ourStoryContent');
        $api->get('/services-content', 'WebsiteContentController@servicesContent');
        $api->get('/elite-services-content', 'WebsiteContentController@eliteServicesContent');
        $api->get('/general-aviation-content', 'WebsiteContentController@generalAviationContent');
        $api->get('/contact-us-content', 'WebsiteContentController@contactUsContent');

        /*******************************
         * Payment
         *******************************/
        $api->get('/payments/redirect','\App\Http\Controllers\HomeController@paymentRedirect'); // Payments Redirect
        $api->get('/payments/verify-benefit','\App\Http\Controllers\PaymentController@verifyBenefitPayment'); // Verify Benefit Payment
        $api->get('/payments/verify-credimax','\App\Http\Controllers\PaymentController@verifyCredimaxPayment'); // Verify Credimax Payment
        $api->get('/receipt/{transaction_id}', 'EliteServiceController@generateReceipt');

    });
});
