<?php

namespace Vinkla\Tests\Hashids;

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

class ServiceProviderTest extends AbstractTestCase
{
	use ServiceProviderTestCaseTrait;

	public function HashidsFactoryIsInjectable()
	{
		$this->assertIsInjectable('Vinkla\Hashids\Factories\HashidsFactory');
	}

	public function HashidsManagerIsInjectable()
	{
		$this->assertIsInjectable('Vinkla\Hashids\HashidsManager');
	}
}
