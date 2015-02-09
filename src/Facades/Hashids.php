<?php

namespace Vinkla\Hashids\Facades;

use Illuminate\Support\Facades\Facade;

class Hashids extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'hashids';
	}
}
