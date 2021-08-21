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
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_SECRET_KEY'),
        'redirect' => 'https://kuldeep.camosys.com/auth/google/callback',
    ],
    'facebook' => [
     'client_id' => env('FACEBOOK_CLIENT_ID'),
     'client_secret' => env('FACEBOOK_SECRET_KEY'),
     'redirect' => 'https://kuldeep.camosys.com/auth/facebook/callback',
   ],
   'linkedin' => [
        'client_id' => env('LINKDIN_CLIENT_ID'),
        'client_secret' => env('LINKDIN_SECRET_KEY'),
        'redirect' => 'https://kuldeep.camosys.com/auth/linkedin/callback'
    ],
    'twitter' => [
     'client_id' => env('TWITTER_CLIENT_ID'),
     'client_secret' => env('TWITTER_SECRET_KEY'),
     'redirect' => 'https://kuldeep.camosys.com/callback/twitter',
 ],
 'github' => [
    'client_id' => env('GITHUB_CLIENT_ID'),
    'client_secret' => env('GITHUB_SECRET_KEY'),
    'redirect' => env('GITHUB_URL'),
],
'recaptcha' => [
        'sitekey' => env('RECAPTCHA_SITEKEY'),
        'secret' => env('RECAPTCHA_SECRET'),
        'register_status' => env('RECAPTCHA_REGISTER_STATUS'),
        'login_status' => env('RECAPTCHA_LOGIN_STATUS'),
        'fpassword_status' => env('RECAPTCHA_FPASSWORD_STATUS'),
       
    ],

];
