<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_SES_ACCESS_KEY_ID'),
        'secret' => env('AWS_SES_SECRET_ACCESS_KEY'),
        'region' => env('AWS_SES_DEFAULT_REGION', 'us-east-1'),
    ],

    'merchant' => [
        'name' => env('MERCHANT_NAME'),
        'address_1' => env('MERCHANT_ADDRESS_1'),
        'address_2' => env('MERCHANT_ADDRESS_2'),
        'currency' => env('MERCHANT_CURRENCY', 'BHD'),
    ],

    'credimax' => [
        'gateway_name' => env('GATEWAY_NAME'),
        'merchant_id' => env('CREDIMAX_MERCHANT_ID'),
        'api_password' => env('CREDIMAX_API_PASSWORD'),
    ],

    'benefit' => [
        'payment_secret' => env('PAYMENT_SECRET'),
        'merchant_id' => env('BENEFIT_MERCHANT_ID'),
    ],

    'website_url' => env('WEBSITE_URL'),

];
