<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => env('HASHIDS_DEFAULT_CONNECTION', 'main'),

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'salt' => env('HASHIDS_MAIN_SALT', 'your-salt-string'),
            'length' => env('HASHIDS_MAIN_LENGTH', 'your-length-integer'),
            'alphabet' => env('HASHIDS_MAIN_ALPHABET', 'your-alphabet-string')
        ],

        'alternative' => [
            'salt' => env('HASHIDS_ALT_ALPHABET', 'your-salt-string'),
            'length' => env('HASHIDS_ALT_ALPHABET', 'your-length-integer'),
            'alphabet' => env('HASHIDS_ALT_ALPHABET', 'your-alphabet-string')
        ],

    ],

];
