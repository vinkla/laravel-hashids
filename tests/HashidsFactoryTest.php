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

namespace Vinkla\Tests\Hashids;

use Hashids\Hashids;
use Vinkla\Hashids\HashidsFactory;

class HashidsFactoryTest extends AbstractTestCase
{
    public function testMakeStandard(): void
    {
        $factory = $this->getHashidsFactory();

        $return = $factory->make([
            'salt' => 'your-salt-string',
            'length' => 0,
            'alphabet' => 'your-alphabet-string',
        ]);

        $this->assertInstanceOf(Hashids::class, $return);
    }

    protected function getHashidsFactory(): HashidsFactory
    {
        return new HashidsFactory();
    }
}
