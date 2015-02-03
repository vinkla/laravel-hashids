<?php namespace Vinkla\Hashids;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;
use Vinkla\Hashids\Factories\HashidsFactory;

class HashidsManager extends AbstractManager {

	/**
	 * @var HashidsFactory
	 */
	private $factory;

	/**
	 * @param Repository $config
	 * @param HashidsFactory $factory
	 */
	function __construct(Repository $config, HashidsFactory $factory)
	{
		parent::__construct($config);

		$this->factory = $factory;
	}

	/**
	 * Create the connection instance.
	 *
	 * @param array $config
	 *
	 * @return mixed
	 */
	protected function createConnection(array $config)
	{
		return $this->factory->make($config);
	}

	/**
	 * Get the configuration name.
	 *
	 * @return string
	 */
	protected function getConfigName()
	{
		return 'hashids';
	}

	/**
	 * Get the factory instance.
	 *
	 * @return HashidsFactory
	 */
	public function getFactory()
	{
		return $this->factory;
	}

}
