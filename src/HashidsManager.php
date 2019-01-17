<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Hashids;

use Hashids\Hashids;
use \InvalidArgumentException;
use Illuminate\Support\Manager;

/**
 * This is the Hashids manager class.
 *
 * @method string encode(mixed ...$numbers) Encode parameters to generate a hash.
 * @method array decode(string $hash) Decode a hash to the original parameter values.
 * @method string encodeHex(string $str) Encode hexadecimal values and generate a hash string.
 * @method string decodeHex(string $hash) Decode a hexadecimal hash.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class HashidsManager extends Manager
{
    /**
     * The factory instance.
     *
     * @var \Vinkla\Hashids\HashidsFactory
     */
    protected $factory;

    /**
     * Get a default connection.
     *
     * @var string|null
     */
    protected $defaultConnection;

    /**
     * Create a new Hashids manager instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @param  \Vinkla\Hashids\HashidsFactory  $factory
     * @return void
     */
    public function __construct($app, HashidsFactory $factory)
    {
        parent::__construct($app);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param  string  $driver
     * @return \Hashids\Hashids
     */
    public function createDriver($driver): Hashids
    {
        // First, we will determine if a custom driver creator exists for the given driver and
        // if it does not we will check for a creator method for the driver. Custom creator
        // callbacks allow developers to build their own "drivers" easily using Closures.
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver);
        } else {
            $config = $this->app['config']->get("hashids.connections.{$driver}");

            if (is_array($config)) {
                return $this->factory->make($config);
            }
        }

        throw new InvalidArgumentException("Connection [$driver] not configured.");
    }

    /**
     * Get a connection.
     *
     * @param  string|null  $name
     * @return \Hashids\Hashids
     */
    public function connection($name = null)
    {
        return $this->driver($name);
    }

    /**
     * Get the default connection name.
     *
     * @return string
     */
    public function getDefaultConnection()
    {
        return $this->defaultConnection ?? $this->app['config']->get('hashids.default');
    }

    /**
     * Alias for "getDefaultConnection" method.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->getDefaultConnection();
    }

    /**
     * Set a default connection.
     *
     * @param  string  $name
     * @return void
     */
    public function setDefaultConnection($name)
    {
        $this->defaultConnection = $name;
    }

    /**
     * Get the factory instance.
     *
     * @return \Vinkla\Hashids\HashidsFactory
     */
    public function getFactory(): HashidsFactory
    {
        return $this->factory;
    }
}
