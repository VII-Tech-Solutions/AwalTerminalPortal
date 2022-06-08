<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::get('register', function () {
        return redirect('/404');});
    Route::crud('general-services', 'GeneralAviationCrudController');
    Route::crud('about-us', 'AboutUsCrudController');
    Route::crud('contact-us', 'ContactUsCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('airport', 'AirportCrudController');
    Route::crud('country', 'CountryCrudController');
    Route::crud('elite-services', 'EliteServicesCrudController');
}); // this should be the absolute last line of this file
