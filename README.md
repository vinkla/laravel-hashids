Laravel 5 Hashids
=================

![image](https://raw.githubusercontent.com/vinkla/vinkla.github.io/master/images/laravel-hashids.png)

Laravel 5 wrapper for the [Hashids](http://hashids.org) API. [Hashids](http://hashids.org) is a small open-source library that generates short, unique, non-sequential ids from numbers.

```php
// Encode integers.
Hashids::encode(4815162342);

// Decode strings.
Hashids::decode('1LLb3b4ck');

// Dependency injection example.
$hashidsManager->encode(911);
```

[![Build Status](https://img.shields.io/travis/vinkla/hashids/master.svg?style=flat)](https://travis-ci.org/vinkla/hashids)
[![StyleCI](https://styleci.io/repos/30237105/shield?style=flat)](https://styleci.io/repos/30237105)
[![Latest Stable Version](http://img.shields.io/packagist/v/vinkla/hashids.svg?style=flat)](https://packagist.org/packages/vinkla/hashids)
[![License](https://img.shields.io/packagist/l/vinkla/hashids.svg?style=flat)](https://packagist.org/packages/vinkla/hashids)

## Installation
Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
composer require vinkla/hashids:~1.0
```

Add the service provider to ```config/app.php``` in the `providers` array.

```php
'Vinkla\Hashids\HashidsServiceProvider'
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in ```config/app.php``` to your aliases array.

```php
'Hashids' => 'Vinkla\Hashids\Facades\Hashids'
```

#### Looking for a Laravel 4 compatible version?

Please use [@mitchellvanw's Laravel 4 Hashids package](https://github.com/mitchellvanw/hashids) instead.

## Configuration

Laravel Hashids requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
php artisan vendor:publish
```

This will create a `config/hashids.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### Hashids Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.


## Usage

#### HashidsManager

This is the class of most interest. It is bound to the ioc container as `hashids` and can be accessed using the `Facades\Hashids` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of [@GrahamCampbell Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `Hashids\Hashids`.

#### Facades\Hashids

This facade will dynamically pass static method calls to the `Hashids` object in the ioc container which by default is the `HashidsManager` class.

#### HashidsServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

### Examples
Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
// You can alias this in config/app.php.
use Vinkla\Hashids\Facades\Hashids;

Hashids::encode(4815162342);
// We're done here - how easy was that, it just works!

Hashids::decode('doyouthinkthatsairyourebreathingnow');
// This example is simple and there are far more methods available.
```

The Hashids manager will behave like it is a `Hashids\Hashids`. If you want to call specific connections, you can do that with the connection method:

```php
use Vinkla\Hashids\Facades\Hashids;

// Writing this…
Hashids::connection('main')->encode($id);

// …is identical to writing this
Hashids::encode($id);

// and is also identical to writing this.
Hashids::connection()->encode($id);

// This is because the main connection is configured to be the default.
Hashids::getDefaultConnection(); // This will return main.

// We can change the default connection.
Hashids::setDefaultConnection('alternative'); // The default is now alternative.
```

If you prefer to use dependency injection over facades like me, then you can inject the manager:

```php
use Vinkla\Hashids\HashidsManager;

class Foo
{
	protected $Hashids;

	public function __construct(HashidsManager $hashids)
	{
		$this->hashids = $hashids;
	}

	public function bar($id)
	{
		$this->hashids->encode($id)
	}
}

App::make('Foo')->bar();
```

## Documentation
There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [@ivanakimov's Hashids package](https://github.com/ivanakimov/hashids.php).

## License

The Laravel Hashids package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
