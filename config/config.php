<?php

return [
    /*
    |--------------------------------------------------------------------------
    | SlimUrl database settings
    |--------------------------------------------------------------------------
    |
    | Here are database settings for laravel-admin builtin model & tables.
    |
    */
    'database' => [
        'table' => 'slim_urls',
        'model' => \D0ggy\LaraSlimUrl\Models\SlimUrl::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | SlimUrl route settings
    |--------------------------------------------------------------------------
    */
    'route' => [
        /*
         * access short url through the path with prefix.
         * eg 'http://domain.com/s/A8DV1E'
         */
        'prefix' => env('SLIM_URL_PREFIX', 's'),

        'middleware' => ['web'],

        'raw_string' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',
    ],

];
