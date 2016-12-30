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

namespace Vinkla\Tests\Hashids;

use Hashids\Hashids;
use Vinkla\Hashids\HashidsFactory;

/**
 * This is the Hashids factory test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class HashidsFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getHashidsFactory();

        $return = $factory->make([
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
            'alphabet' => 'your-alphabet-string',
        ]);

        $this->assertInstanceOf(Hashids::class, $return);
    }

    protected function getHashidsFactory()
    {
        return new HashidsFactory();
    }
}
