<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@welcome');
Route::get('/', 'App\Http\Controllers\HomeController@welcome');
Route::get('/process', 'App\Http\Controllers\HomeController@process');
Route::get('/elite-service/pay', "App\Http\Controllers\HomeController@pay")->name("elite-service-payment");
Route::get('/elite-service/pay/process', "App\Http\Controllers\HomeController@processPayment")->name("elite-service-process-payment");

Route::get('/rejectSubmission', "App\Http\Controllers\HomeController@rejectSubmission");
Route::get('/approveSubmission', "App\Http\Controllers\HomeController@approveSubmission");
Route::get('/bookingSubmission', "App\Http\Controllers\HomeController@bookingSubmission");

Route::get('/generalAviationSubmission', "App\Http\Controllers\HomeController@generalAviationSubmission");
Route::get('/generalAviationReject', "App\Http\Controllers\HomeController@generalAviationReject");
Route::get('/generalAviationApprove', "App\Http\Controllers\HomeController@generalAviationApprove");
