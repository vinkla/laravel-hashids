# Laravel Hashids

![hashids](https://cloud.githubusercontent.com/assets/499192/11159205/faa429ae-8a5d-11e5-8c5d-c60a89290c5e.png)

> A [Hashids](http://hashids.org) bridge for Laravel.

```php
// Encode integers.
Hashids::encode(4815162342);

// Decode strings.
Hashids::decode('1LLb3b4ck');

// Dependency injection example.
$hashidsManager->encode(911);
```

[![Build Status](https://badgen.net/travis/vinkla/laravel-hashids/master)](https://travis-ci.org/vinkla/laravel-hashids)
[![Coverage Status](https://badgen.net/codecov/c/github/vinkla/laravel-hashids)](https://codecov.io/github/vinkla/laravel-hashids)
[![Total Downloads](https://badgen.net/packagist/dt/vinkla/hashids)](https://packagist.org/packages/vinkla/hashids)
[![Latest Version](https://badgen.net/github/release/vinkla/hashids)](https://github.com/vinkla/hashids/releases)
[![License](https://badgen.net/packagist/license/vinkla/hashids)](https://packagist.org/packages/vinkla/hashids)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require vinkla/hashids
```

## Configuration

Laravel Hashids requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/hashids.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### Hashids Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.


## Usage

#### HashidsManager

This is the class of most interest. It is bound to the ioc container as `hashids` and can be accessed using the `Facades\Hashids` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of the [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `Hashids\Hashids`.

#### Facades\Hashids

This facade will dynamically pass static method calls to the `hashids` object in the ioc container which by default is the `HashidsManager` class.

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
    protected $hashids;

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

There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [Ivan Akimov's](https://github.com/ivanakimov) [Hashids package](https://github.com/vinkla/hashids.php#readme).

## License

[MIT](LICENSE) © [Vincent Klaiber](https://doubledip.se)
