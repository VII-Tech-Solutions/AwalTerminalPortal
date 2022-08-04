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

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->get('/', function () {
        return ['status' => true];
    });
    $api->group(['namespace' => 'App\API\Controllers'], function () use ($api) {
        $api->get('/elite-service/all', 'EliteServiceController@all');
        $api->get('/metadata', 'MetadataController@all');
        $api->get('/elite-service/{uuid}', 'EliteServiceController@getOne');
        $api->post('/elite-service', 'EliteServiceController@submitForm');
        $api->get('/calculate-price', 'EliteServiceController@calculatePrice');
        $api->post('/general-aviation', 'GeneralAviationFormController@submitForm');
        $api->post('/general-aviation/media', 'GeneralAviationFormController@uploadMedia');
        $api->post('/contact-us', 'ContactUsController@submitForm');
        $api->get('/homepage-content', 'WebsiteContentController@homepageContent');
        $api->get('/tour-the-terminal-content', 'WebsiteContentController@tourTheTerminalContent');
        $api->get('/our-story-content', 'WebsiteContentController@ourStoryContent');
        $api->get('/services-content', 'WebsiteContentController@servicesContent');
        $api->get('/elite-services-content', 'WebsiteContentController@eliteServicesContent');
        $api->get('/general-aviation-content', 'WebsiteContentController@generalAviationContent');
        $api->get('/contact-us-content', 'WebsiteContentController@contactUsContent');
        $api->get('/payments/redirect','\App\Http\Controllers\PaymentController@paymentRedirect')->middleware('allowed_user:true'); // Payments Redirect
        $api->get('/payments/verify-benefit','\App\Http\Controllers\PaymentController@verifyBenefitPayment')->middleware('allowed_user:true'); // Verify Benefit Payment
        $api->get('/payments/verify-credimax','\App\Http\Controllers\PaymentController@verifyCredimaxPayment')->middleware('allowed_user:true'); // Verify Credimax Payment

    });
});
