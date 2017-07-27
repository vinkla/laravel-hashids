<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

 /*
|--------------------------------------------------------------------------
| Default Hashid Salt
|--------------------------------------------------------------------------
|
| Here where it is defining a unique key based on HTTP_HOST and application
| environment contents. So, this script is expecting to found .env file.
| This key is generated and hashed with SHA-256 every time when using
| the following command:
|
|   php artisan config:cache
|
*/

$user_default_salt = 'your-salt-string'; // This salt will be ignored all time, if .env file exists.

$extra_key = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';

$env_path = realpath(dirname(__FILE__).'/../.env');

if ($env_path) {
    $main_hashid_default_salt = file_exists($env_path) ? hash('sha256', file_get_contents($env_path).$extra_key) : $user_default_salt;
} else {
    $main_hashid_default_salt = $user_default_salt;
}

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

    'default' => 'main',

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
            'salt' => $main_hashid_default_salt,
            'length' => 'your-length-integer',
        ],

        'alternative' => [
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
        ],

    ],

];
