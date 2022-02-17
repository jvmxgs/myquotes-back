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

    'quote_garden' => [
        'url' => env('QUOTE_GARDEN_URL'),
        'random_single_url' => env('QUOTE_GARDEN_RANDOM_SINGLE_URL')
    ],

    'quotes_on_design' => [
        'url' => env('QUOTES_ON_DESIGN_URL')
    ],

    'stoic_quoute' => [
        'url' => env('STOIC_QUOTE_URL'),
        'random_single_url' => env('STOIC_QUOTE_RANDOM_SINGLE_URL')
    ],

    'zen_qoutes' => [
        'url' => env('ZEN_QUOTES_URL'),
        'random_single_url' => env('ZEN_QUOTES_RANDOM_SINGLE_URL')
    ],
];
