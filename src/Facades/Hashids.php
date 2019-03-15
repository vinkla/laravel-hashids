<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@doubledip.se>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Hashids\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the Hashids facade class.
 *
 * @author Vincent Klaiber <hello@doubledip.se>
 *
 * @method static string encode(mixed ...$numbers) Encode parameters to generate a hash.
 * @method static array decode(string $hash) Decode a hash to the original parameter values.
 * @method static string encodeHex(string $str) Encode hexadecimal values and generate a hash string.
 * @method static string decodeHex(string $hash) Decode a hexadecimal hash.
 */
class Hashids extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'hashids';
    }
}
