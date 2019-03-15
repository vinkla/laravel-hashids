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
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the Hashids service provider class.
 *
 * @author Vincent Klaiber <hello@doubledip.se>
 */
class HashidsServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig(): void
    {
        $source = realpath($raw = __DIR__.'/../config/hashids.php') ?: $raw;

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('hashids.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('hashids');
        }

        $this->mergeConfigFrom($source, 'hashids');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory(): void
    {
        $this->app->singleton('hashids.factory', function () {
            return new HashidsFactory();
        });

        $this->app->alias('hashids.factory', HashidsFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager(): void
    {
        $this->app->singleton('hashids', function (Container $app) {
            $config = $app['config'];
            $factory = $app['hashids.factory'];

            return new HashidsManager($config, $factory);
        });

        $this->app->alias('hashids', HashidsManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings(): void
    {
        $this->app->bind('hashids.connection', function (Container $app) {
            $manager = $app['hashids'];

            return $manager->connection();
        });

        $this->app->alias('hashids.connection', Hashids::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'hashids',
            'hashids.factory',
            'hashids.connection',
        ];
    }
}
