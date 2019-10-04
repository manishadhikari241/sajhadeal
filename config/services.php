<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'google' => [
        'client_id' => '750386546395-pu2mvb8a5ulukb7o0b4af18vslk668rh.apps.googleusercontent.com',
        'client_secret' => 'sdK-TemWuOa7N2URYFMFv-cG',
        'redirect' => 'https://sajhadeal.com/login/google/callback',
    ],

    'facebook' => [
        'client_id' => '599765137114127',
        'client_secret' => 'ef569cec11ae80ec0240322d37d4e279',
        'redirect' => 'https://sajhadeal.com/login/facebook/callback',
    ],

];
