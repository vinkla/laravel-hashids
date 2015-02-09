<?php

namespace Vinkla\Tests\Hashids\Factories;

use Vinkla\Hashids\Factories\HashidsFactory;
use Vinkla\Tests\Hashids\AbstractTestCase;

class HashidsFactoryTest extends AbstractTestCase
{
	public function testMakeStandard()
	{
		$factory = $this->getHashidsFactory();

		$return = $factory->make([
			'salt' => 'your-sal-string',
			'length' => 'your-length-integer',
			'alphabet' => 'your-alphabet-string'
		]);

		$this->assertInstanceOf('Hashids\Hashids', $return);
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testMakeWithoutClientId()
	{
		$factory = $this->getHashidsFactory();

		$factory->make([]);
	}

	protected function getHashidsFactory()
	{
		return new HashidsFactory();
	}

}
