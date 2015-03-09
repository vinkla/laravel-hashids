<?php

namespace Vinkla\Tests\Hashids\Facades;

use GrahamCampbell\TestBench\Traits\FacadeTestCaseTrait;
use Vinkla\Tests\Hashids\AbstractTestCase;

class HashidsTest extends AbstractTestCase
{
    use FacadeTestCaseTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'hashids';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return 'Vinkla\Hashids\Facades\Hashids';
    }

    /**
     * Get the facade route.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return 'Vinkla\Hashids\HashidsManager';
    }
}
