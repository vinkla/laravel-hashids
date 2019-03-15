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

namespace Vinkla\Tests\Hashids\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Vinkla\Hashids\Facades\Hashids;
use Vinkla\Hashids\HashidsManager;
use Vinkla\Tests\Hashids\AbstractTestCase;

/**
 * This is the Hashids facade test class.
 *
 * @author Vincent Klaiber <hello@doubledip.se>
 */
class HashidsTest extends AbstractTestCase
{
    use FacadeTrait;

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
        return Hashids::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return HashidsManager::class;
    }
}
