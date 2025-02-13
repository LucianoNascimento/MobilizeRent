<?php

return [

    /*
    |--------------------------------------------------------------------------
    | authentication defaults
    |--------------------------------------------------------------------------
    |
    | this option defines the default authentication "guard" and password
    | reset "broker" for your application. you may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('auth_guard', 'web'),
        'passwords' => env('auth_password_broker', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | authentication guards
    |--------------------------------------------------------------------------
    |
    | next, you may define every authentication guard for your application.
    | of course, a great default configuration has been defined for you
    | which utilizes session storage plus the eloquent user provider.
    |
    | all authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. typically, eloquent is utilized.
    |
    | supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'sanctum',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | user providers
    |--------------------------------------------------------------------------
    |
    | all authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. typically, eloquent is utilized.
    |
    | if you have multiple user tables or models you may configure multiple
    | providers to represent the model / table. these providers may then
    | be assigned to any extra authentication guards you have defined.
    |
    | supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\models\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | resetting passwords
    |--------------------------------------------------------------------------
    |
    | these configuration options specify the behavior of laravel's password
    | reset functionality, including the table utilized for token storage
    | and the user provider that is invoked to actually retrieve users.
    |
    | the expiry time is the number of minutes that each reset token will be
    | considered valid. this security feature keeps tokens short-lived so
    | they have less time to be guessed. you may change this as needed.
    |
    | the throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. this prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('auth_password_reset_token_table', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | password confirmation timeout
    |--------------------------------------------------------------------------
    |
    | here you may define the amount of seconds before a password confirmation
    | window expires and users are asked to re-enter their password via the
    | confirmation screen. by default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => env('auth_password_timeout', 10800),

];
