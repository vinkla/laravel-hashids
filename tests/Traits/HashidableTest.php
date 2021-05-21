<?php

namespace Vinkla\Tests\Hashids\Traits;

use Illuminate\Database\QueryException;
use Vinkla\Tests\Hashids\AbstractTestCase;
use Vinkla\Tests\Hashids\Mocks\FooModel;

class HashidableTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->app->register(\Vinkla\Hashids\HashidsServiceProvider::class);
    }

    public function testEncodeId(): void
    {
        $result = FooModel::encodeHashId(1);

        $this->assertEquals('oG', $result);
    }

    public function testDecodesId(): void
    {
        $result = FooModel::decodeHashId('oG');
        $this->assertEquals(1, $result);
    }

    public function testFindModelByHashId(): void
    {
        try {
            $result = FooModel::findByHashId('oG');
        }
        catch (QueryException $exception) {
            $this->assertEquals('select * from "foos" where "id" = ? limit 1', $exception->getSql());
            $this->assertEquals([1], $exception->getBindings());
        }
    }

    public function testResolvesModelViaRouteBinding(): void
    {
        try {
            $result = (new FooModel)->resolveRouteBinding('oG');
        }
        catch (QueryException $exception) {
            $this->assertEquals('select * from "foos" where "id" = ? limit 1', $exception->getSql());
            $this->assertEquals([1], $exception->getBindings());
        }
    }

    public function testGenerateRouteKey(): void
    {
        $foo = (new FooModel)->forceFill(['id' => 1]);

        $this->assertEquals('oG', $foo->getRouteKey());
    }

    public function testReturnNullWithNullRouteKey(): void
    {
        $result = FooModel::findByHashId(null);
        $this->assertNull($result);
    }
}
