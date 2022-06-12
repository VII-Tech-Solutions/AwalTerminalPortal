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

use Illuminate\Support\Facades\Route;


Route::post('/elite-service/all', 'App\API\Controllers\EliteServiceController@all');
Route::get('/metadata', 'App\API\Controllers\MetadataController@all');
Route::post('/elite-service', 'App\API\Controllers\EliteServiceController@submitForm');
Route::post('/elite-service/all', 'App\API\Controllers\EliteServiceController@all');
Route::post('/general-aviation', 'App\API\Controllers\GeneralAviationFormController@submitForm');
Route::post('/general-aviation/media', 'App\API\Controllers\GeneralAviationFormController@uploadMedia');
Route::post('/contact-us', 'App\API\Controllers\ContactUsController@submitForm');

