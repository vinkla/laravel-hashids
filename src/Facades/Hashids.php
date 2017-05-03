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

namespace Vinkla\Hashids\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the Hashids facade class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
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
    
    /**
     * Encode an integer/array and return hash.
     *
     * @param $ints int|mixed value to be encoded/hashed
     *
     * @return string Hash value
     */
    public static function encode($ints)
    {
        return self::optimize(parent::encode($ints));
    }
    
    /**
     * Decode the value.
     *
     * @param $hash string String hash value to be decoded.
     *
     * @return mixed|int
     */
    public static function decode($hash)
    {
        return self::optimize(parent::decode($hash));
    }
    
    /**
     * Optimize the result to ensure if it is single result,
     * we get single output otherwise get result as sent.
     *
     * @param $result array|int|string
     *
     * @return mixed
     */
    protected static function optimize($result)
    {
        if (is_array($result) && 1 == count($result)) return $result[0];
        return $result;
    }
}
