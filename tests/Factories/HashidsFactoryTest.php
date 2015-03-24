<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Hashids\Factories;

use Vinkla\Hashids\Factories\HashidsFactory;
use Vinkla\Tests\Hashids\AbstractTestCase;

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
            'salt' => 'your-sal-string',
            'length' => 'your-length-integer',
            'alphabet' => 'your-alphabet-string'
        ]);

        $this->assertInstanceOf('Hashids\Hashids', $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutClientId()
    {
        $factory = $this->getHashidsFactory();

        $factory->make([]);
    }

    protected function getHashidsFactory()
    {
        return new HashidsFactory();
    }
}
