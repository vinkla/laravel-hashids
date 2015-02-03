<?php namespace Vinkla\Hashids;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class HashidsServiceProvider extends ServiceProvider {

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->setupConfig();
	}

	/**
	 * Setup the config.
	 *
	 * @return void
	 */
	protected function setupConfig()
	{
		$source = realpath(__DIR__.'/../config/hashids.php');
		$this->publishes([$source => config_path('hashids.php')]);
		$this->mergeConfigFrom($source, 'hashids');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerFactory($this->app);
		$this->registerManager($this->app);
	}

	/**
	 * Register the factory class.
	 *
	 * @param \Illuminate\Contracts\Foundation\Application $app
	 *
	 * @return void
	 */
	protected function registerFactory(Application $app)
	{
		$app->singleton('hashids.factory', function()
		{
			return new Factories\HashidsFactory();
		});
		$app->alias('hashids.factory', 'Vinkla\Hashids\Factories\HashidsFactory');
	}

	/**
	 * Register the manager class.
	 *
	 * @param \Illuminate\Contracts\Foundation\Application $app
	 *
	 * @return void
	 */
	protected function registerManager(Application $app)
	{
		$app->singleton('hashids', function($app)
		{
			$config = $app['config'];
			$factory = $app['hashids.factory'];

			return new HashidsManager($config, $factory);
		});

		$app->alias('hashids', 'Vinkla\Hashids\HashidsManager');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return string[]
	 */
	public function provides()
	{
		return [
			'hashids',
			'hashids.factory'
		];
	}

}
