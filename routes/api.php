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

use App\API\Controllers\ContactUsController;
use Dingo\Api\Routing\Router;

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->get('/', function () {
        return ['status' => true];
    });
    $api->group(['namespace' => 'App\API\Controllers'], function () use ($api) {
//    $api->get('/contact-us/all','ContactUsController@all');
    $api->get('/elite-service/all','EliteServiceController@all');
    $api->post('/elite-service','EliteServiceController@add');
    $api->post('/general-aviation','GeneralAviationFormController@submitForm');
    $api->post('/general-aviation/uploadMedia','GeneralAviationFormController@uploadMedia');
    $api->post('/contact-us/add','ContactUsController@submitForm');
    });
});
