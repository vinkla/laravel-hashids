<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

declare(strict_types=1);

namespace Vinkla\Hashids\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string encode(mixed ...$numbers) Encode parameters to generate a hash.
 * @method static array decode(string $hash) Decode a hash to the original parameter values.
 * @method static string encodeHex(string $str) Encode hexadecimal values and generate a hash string.
 * @method static string decodeHex(string $hash) Decode a hexadecimal hash.
 */
class Hashids extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'hashids';
    }
}
