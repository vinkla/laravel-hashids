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

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Hashids\Hashids;
use Vinkla\Hashids\HashidsFactory;
use Vinkla\Hashids\HashidsManager;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testHashidsFactoryIsInjectable()
    {
        $this->assertIsInjectable(HashidsFactory::class);
    }

    public function testHashidsManagerIsInjectable()
    {
        $this->assertIsInjectable(HashidsManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Hashids::class);

        $original = $this->app['hashids.connection'];
        $this->app['hashids']->reconnect();
        $new = $this->app['hashids.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
