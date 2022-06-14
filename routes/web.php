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
