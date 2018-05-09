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
    ],

    'github' => [
      'client_id' => env('GITHUB_CLIENT_ID'),
      'client_secret' => env('GITHUB_CLIENT_SECRET'),
      'redirect' => env('GITHUB_REDIRECT_URL'),
    ],
    'twitter' => [
    	'consumer_key'    => env('TWITTER_CONSUMER_KEY'),
    	'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),
    	'access_token'    => env('TWITTER_ACCESS_TOKEN'),
    	'access_secret'   => env('TWITTER_ACCESS_SECRET')
    ]
];
