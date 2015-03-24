<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Hashids;

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTestCaseTrait;

    public function testHashidsFactoryIsInjectable()
    {
        $this->assertIsInjectable('Vinkla\Hashids\Factories\HashidsFactory');
    }

    public function testHashidsManagerIsInjectable()
    {
        $this->assertIsInjectable('Vinkla\Hashids\HashidsManager');
    }
}
