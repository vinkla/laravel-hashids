<?php

declare(strict_types=1);

namespace Vinkla\Tests\Hashids\Concerns;

use Hashids\Hashids as HashidsCore;
use Mockery;
use Mockery\MockInterface;
use Vinkla\Hashids\Facades\Hashids;
use Vinkla\Tests\Hashids\AbstractTestCase;

class HasHashIdTest extends AbstractTestCase
{
    private function mockHashids(): HashidsCore&MockInterface
    {
        $mock = Mockery::mock(HashidsCore::class);

        Hashids::shouldReceive('getDefaultConnection')->andReturn('main');
        Hashids::shouldReceive('connection')->with('main')->andReturn($mock);

        return $mock;
    }

    public function testGetHashIdEncodesModelKey(): void
    {
        $this->mockHashids()->shouldReceive('encode')->with(1)->once()->andReturn('jR');

        $this->assertSame('jR', (new FakeModel(['id' => 1]))->getHashId());
    }

    public function testHashIdAttributeMatchesGetHashId(): void
    {
        $this->mockHashids()->shouldReceive('encode')->with(5)->andReturn('oZ');

        $model = new FakeModel(['id' => 5]);

        $this->assertSame($model->getHashId(), $model->hash_id);
    }

    public function testDecodeHashIdReturnsOriginalValue(): void
    {
        $this->mockHashids()->shouldReceive('decode')->with('jR')->once()->andReturn([1]);

        $this->assertSame(1, FakeModel::decodeHashId('jR'));
    }

    public function testDecodeHashIdReturnsNullForInvalidHash(): void
    {
        $this->mockHashids()->shouldReceive('decode')->with('invalid')->once()->andReturn([]);

        $this->assertNull(FakeModel::decodeHashId('invalid'));
    }

    public function testGetConnectionHashIdReturnsDefaultConnection(): void
    {
        Hashids::shouldReceive('getDefaultConnection')->once()->andReturn('main');

        $this->assertSame('main', (new FakeModel())->getConnectionHashId());
    }

    public function testGetConnectionHashIdReturnsCustomConnection(): void
    {
        $this->assertSame('custom', (new FakeModelWithCustomConnection())->getConnectionHashId());
    }

    public function testWhereHashIdsWithSingleString(): void
    {
        $this->mockHashids()->shouldReceive('decode')->with('jR')->once()->andReturn([1]);

        $query = FakeModel::query()->whereHashIds('jR');

        $this->assertSame('select * from "fake_models" where "id" = ?', $query->toSql());
        $this->assertSame([1], $query->getBindings());
    }

    public function testWhereHashIdsWithArray(): void
    {
        $mock = $this->mockHashids();
        $mock->shouldReceive('decode')->with('jR')->once()->andReturn([1]);
        $mock->shouldReceive('decode')->with('oZ')->once()->andReturn([5]);

        $query = FakeModel::query()->whereHashIds(['jR', 'oZ']);

        $this->assertSame('select * from "fake_models" where "id" in (?, ?)', $query->toSql());
        $this->assertSame([1, 5], $query->getBindings());
    }

    public function testWhereHashIdsWithCollection(): void
    {
        $mock = $this->mockHashids();
        $mock->shouldReceive('decode')->with('jR')->once()->andReturn([1]);
        $mock->shouldReceive('decode')->with('oZ')->once()->andReturn([5]);

        $query = FakeModel::query()->whereHashIds(collect(['jR', 'oZ']));

        $this->assertSame('select * from "fake_models" where "id" in (?, ?)', $query->toSql());
        $this->assertSame([1, 5], $query->getBindings());
    }

    public function testWhereHashIdsWithInvalidHashAddsNoConstraint(): void
    {
        $this->mockHashids()->shouldReceive('decode')->with('invalid')->once()->andReturn([]);

        $query = FakeModel::query()->whereHashIds('invalid');

        $this->assertSame('select * from "fake_models"', $query->toSql());
        $this->assertEmpty($query->getBindings());
    }
}
