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

    'ozow' => [
        'active' => env('OZOW_ACTIVE'),
        'liveUrl' => env('OZOW_LIVE_URL'),
        'siteCode' => env('OZOW_SITE_CODE'),
        'privateKey' => env('OZOW_PRIVATE_KEY'),
        'successUrl' => env('APP_URL').env('OZOW_SUCCESS_URL'),
        'cancelUrl' => env('APP_URL').env('OZOW_CANCEL_URL'),
    ],

    'payflex' => [
        'clientId' => env('PAYFLEX_CLIENT_ID'),
        'secret' => env('PAYFLEX_CLIENT_SECRET'),
        'active' => env('PAYFLEX_ACTIVE'),
        'successUrl' => env('APP_URL').env('PAYFLEX_SUCCESS_URL'),
        'cancelUrl' => env('APP_URL').env('PAYFLEX_CANCEL_URL'),
        'baseUrl' => env('PAYFLEX_BASE_URL'),
        'authUrl' => env('PAYFLEX_AUTH_URL'),
        'audience' => env('PAYFLEX_AUDIENCE'),
    ],

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
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
