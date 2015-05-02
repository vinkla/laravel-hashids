<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Hashids\Facades;

use GrahamCampbell\TestBench\Traits\FacadeTestCaseTrait;
use Vinkla\Tests\Hashids\AbstractTestCase;

/**
 * This is the Hashids facade test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class HashidsTest extends AbstractTestCase
{
    use FacadeTestCaseTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'hashids';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return 'Vinkla\Hashids\Facades\Hashids';
    }

    /**
     * Get the facade route.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return 'Vinkla\Hashids\HashidsManager';
    }
}
