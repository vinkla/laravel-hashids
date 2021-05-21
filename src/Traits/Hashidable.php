<?php

namespace Vinkla\Hashids\Traits;

use Illuminate\Support\Arr;
use Vinkla\Hashids\HashidsFactory;

trait Hashidable
{
    private static function getHashids(): \Hashids\Hashids
    {
        $connections = config('hashids.connections');
        $config = Arr::get($connections, __CLASS__, $connections[config('hashids.default')]);
        /** @var HashidsFactory $factory */
        $factory = app('hashids.factory');

        return $factory->make(array_replace(
            $config,
            [
                'salt' => __CLASS__ . $config['salt']
            ]
        ));
    }

    public function getRouteKey(): string
    {
        return self::encodeHashId(parent::getRouteKey());
    }

    public function resolveRouteBinding($value, $field = null): ?self
    {
        return self::findByHashId($value);
    }

    public static function findByHashId(?string $hashId)
    {
        if ($id = self::decodeHashId($hashId)) {
            $model = new self();

            return $model->where($model->getRouteKeyName(), $id)->first();
        }

        return null;
    }

    public static function decodeHashId(?string $value): ?int
    {
        $result = self::getHashids()->decode($value);

        return count($result) ? $result[0] : null;
    }

    public static function encodeHashId($value): string
    {
        return self::getHashids()->encode($value);
    }
}
