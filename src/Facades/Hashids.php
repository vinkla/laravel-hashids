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
}
