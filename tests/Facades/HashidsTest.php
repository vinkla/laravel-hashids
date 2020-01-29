<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

declare(strict_types=1);

namespace Vinkla\Tests\Hashids\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Vinkla\Hashids\Facades\Hashids;
use Vinkla\Hashids\HashidsManager;
use Vinkla\Tests\Hashids\AbstractTestCase;

class HashidsTest extends AbstractTestCase
{
    use FacadeTrait;

    protected function getFacadeAccessor()
    {
        return 'hashids';
    }

    protected function getFacadeClass()
    {
        return Hashids::class;
    }

    protected function getFacadeRoot()
    {
        return HashidsManager::class;
    }
}
