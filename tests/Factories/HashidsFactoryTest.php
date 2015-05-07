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
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
            'alphabet' => 'your-alphabet-string',
        ]);

        $this->assertInstanceOf('Hashids\Hashids', $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSalt()
    {
        $factory = $this->getHashidsFactory();

        $factory->make([
            'length' => 'your-length-integer',
            'alphabet' => 'your-alphabet-string',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutLength()
    {
        $factory = $this->getHashidsFactory();

        $factory->make([
            'salt' => 'your-salt-string',
            'alphabet' => 'your-alphabet-string',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutAlphabet()
    {
        $factory = $this->getHashidsFactory();

        $factory->make([
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
        ]);
    }

    protected function getHashidsFactory()
    {
        return new HashidsFactory();
    }
}
