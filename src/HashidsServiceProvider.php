<?php

/**
 * Copyright (c) Vincent Klaiber
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

declare(strict_types=1);

namespace Vinkla\Hashids;

use Hashids\Hashids;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class HashidsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->setupConfig();

        $this->defineHashIdField();
    }

    private function defineHashIdField()
    {
        Blueprint::macro("hashId", function($name = null) {
            /**
             * @var \Illuminate\Database\Schema\Blueprint $this
             */
            return $this->string($name ?? config('hashids.hash_id_field'));
        });
        
        Blueprint::macro("dropHashId", function($name = null) {
            /**
             * @var \Illuminate\Database\Schema\Blueprint $this
             */
            return $this->dropColumn($name ?? config('hashids.hash_id_field'));
        });
    }

    protected function setupConfig(): void
    {
        $source = realpath($raw = __DIR__ . '/../config/hashids.php') ?: $raw;

        $this->publishes([$source => config_path('hashids.php')]);

        $this->mergeConfigFrom($source, 'hashids');
    }

    public function register(): void
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    protected function registerFactory(): void
    {
        $this->app->singleton('hashids.factory', function () {
            return new HashidsFactory();
        });

        $this->app->alias('hashids.factory', HashidsFactory::class);
    }

    protected function registerManager(): void
    {
        $this->app->singleton('hashids', function (Container $app) {
            $config = $app['config'];
            $factory = $app['hashids.factory'];

            return new HashidsManager($config, $factory);
        });

        $this->app->alias('hashids', HashidsManager::class);
    }

    protected function registerBindings(): void
    {
        $this->app->bind('hashids.connection', function (Container $app) {
            $manager = $app['hashids'];

            return $manager->connection();
        });

        $this->app->alias('hashids.connection', Hashids::class);
    }

    public function provides(): array
    {
        return [
            'hashids',
            'hashids.factory',
            'hashids.connection',
        ];
    }
}
