<?php

namespace Vinkla\Hashids\Factories;

use Hashids\Hashids;

class HashidsFactory
{
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
     * @return array
     */
    protected function getConfig(array $config)
    {
        $keys = ['salt', 'length', 'alphabet'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new \InvalidArgumentException('The Hashids client requires configuration.');
            }
        }

        return array_only($config, $keys);
    }
}
