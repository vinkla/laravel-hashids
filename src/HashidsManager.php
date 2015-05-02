<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Hashids;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;
use Vinkla\Hashids\Factories\HashidsFactory;

/**
 * This is the Hashids manager class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class HashidsManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Vinkla\Hashids\Factories\HashidsFactory
     */
    private $factory;

    /**
     * Create a new Hashids manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Vinkla\Hashids\Factories\HashidsFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, HashidsFactory $factory)
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
     * @return \Vinkla\Hashids\Factories\HashidsFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
