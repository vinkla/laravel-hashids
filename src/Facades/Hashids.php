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
 * @method \Hashids\Hashids encode(mixed ...$numbers)
 * @method \Hashids\Hashids decode(string $hash)
 * @method \Hashids\Hashids encodeHex(string $str)
 * @method \Hashids\Hashids decodeHex(string $hash)
 */
class Hashids extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'hashids';
    }
}
