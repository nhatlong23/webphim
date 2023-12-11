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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'cloudinary' => [
        'cloud_name' => env('phimmoi48h'),
        'api_key' => env('937766163417813'),
        'api_secret' => env('zufGxvbkZaLqEirurMibDNAFMpE'),
    ],

    'google' => [
        'client_id' => env('CLIENT_ID_GOOGLE'),
        'client_secret' => env('CLIENT_SECRET_GOOGLE'),
        'redirect' => env('APP_URL').'/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => env('CLIENT_ID_FACEBOOK'),
        'client_secret' => env('CLIENT_SECRET_FACEBOOK'),
        'redirect' =>  env('APP_URL').'/auth/facebook/callback',
    ],

];
