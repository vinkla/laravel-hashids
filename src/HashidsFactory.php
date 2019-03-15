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

namespace Vinkla\Hashids;

use Hashids\Hashids;

/**
 * This is the Hashids factory class.
 *
 * @author Vincent Klaiber <hello@doubledip.se>
 */
class HashidsFactory
{
    /**
     * Make a new Hashids client.
     *
     * @param array $config
     *
     * @return \Hashids\Hashids
     */
    public function make(array $config): Hashids
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param array $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config): array
    {
        return [
            'salt' => array_get($config, 'salt', ''),
            'length' => array_get($config, 'length', 0),
            'alphabet' => array_get($config, 'alphabet', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'),
        ];
    }

    /**
     * Get the hashids client.
     *
     * @param array $config
     *
     * @return \Hashids\Hashids
     */
    protected function getClient(array $config): Hashids
    {
        return new Hashids($config['salt'], $config['length'], $config['alphabet']);
    }
}
