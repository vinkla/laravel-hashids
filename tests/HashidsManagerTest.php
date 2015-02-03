<?php namespace Vinkla\Tests\Hashids;

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Mockery;
use Vinkla\Hashids\HashidsManager;

class HashidsManagerTest extends AbstractTestBenchTestCase {

	public function testCreateConnection()
	{
		$config = ['path' => __DIR__];

		$manager = $this->getManager($config);

		$manager->getConfig()->shouldReceive('get')->once()
			->with('hashids.default')->andReturn('hashids');

		$this->assertSame([], $manager->getConnections());

		$return = $manager->connection();

		$this->assertInstanceOf('Hashids\Hashids', $return);

		$this->assertArrayHasKey('hashids', $manager->getConnections());
	}

	protected function getManager(array $config)
	{
		$repository = Mockery::mock('Illuminate\Contracts\Config\Repository');
		$factory = Mockery::mock('Vinkla\Hashids\Factories\HashidsFactory');

		$manager = new HashidsManager($repository, $factory);

		$manager->getConfig()->shouldReceive('get')->once()
			->with('hashids.connections')->andReturn(['hashids' => $config]);

		$config['name'] = 'hashids';

		$manager->getFactory()->shouldReceive('make')->once()
			->with($config)->andReturn(Mockery::mock('Hashids\Hashids'));

		return $manager;
	}

}
