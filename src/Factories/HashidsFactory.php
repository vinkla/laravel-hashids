<?php namespace Vinkla\Hashids\Factories;

use Hashids\Hashids;

class HashidsFactory {

	/**
	 * Make a new Hashids client.
	 *
	 * @param array $config
	 * @return Hashids
	 */
	public function make(array $config)
	{
		$config = $this->getConfig($config);

		return new Hashids(
			$config['salt'],
			$config['length'],
			$config['alphabet']
		);
	}

	/**
	 * Get the configuration data.
	 *
	 * @param string[] $config
	 *
	 * @throws \InvalidArgumentException
	 *
	 * @return string
	 */
	protected function getConfig(array $config)
	{
		if (!array_key_exists('salt', $config) || !array_key_exists('length', $config) || !array_key_exists('alphabet', $config)) {
			throw new \InvalidArgumentException('The Hashids client requires authentication.');
		}

		return array_only($config, ['salt', 'length', 'alphabet']);
	}

}
