<?php

namespace Vinkla\Tests\Hashids;

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

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
