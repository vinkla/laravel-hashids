Laravel 5 Hashids
=================
Laravel 5 wrapper for the [Hashids API](http://hashids.org).

[![Build Status](https://img.shields.io/travis/vinkla/hashids/master.svg?style=flat)](https://travis-ci.org/vinkla/hashids)
[![Latest Stable Version](http://img.shields.io/packagist/v/vinkla/hashids.svg?style=flat)](https://packagist.org/packages/vinkla/hashids)
[![License](https://img.shields.io/packagist/l/vinkla/hashids.svg?style=flat)](https://packagist.org/packages/vinkla/hashids)

## Installation
Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
composer require "vinkla/hashids=~1.0"
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
Documentation coming soon…
