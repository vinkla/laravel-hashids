<?php

declare(strict_types=1);

namespace Vinkla\Hashids\Concerns;

use Hashids\Hashids as HashidsCore;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Collection;
use Vinkla\Hashids\Facades\Hashids;

trait HasHashId
{
    /**
     * Get the Hashids connection name for this model.
     */
    public function getConnectionHashId(): string
    {
        return $this->connectionHashId ?? Hashids::getDefaultConnection();
    }

    /**
     * Resolve the Hashids instance for the model's connection.
     */
    protected function resolveHashId(): HashidsCore
    {
        return Hashids::connection($this->getConnectionHashId());
    }

    /**
     * Find a model by its hash ID.
     */
    public static function findByHashId(string $hashId): ?static
    {
        $instance = new static;
        $decoded = $instance->resolveHashId()->decode($hashId);

        if (empty($decoded)) {
            return null;
        }

        return static::find($decoded[0]);
    }

    /**
     * Decode a hash ID to its original value.
     */
    public static function decodeHashId(string $hashId): int|string|null
    {
        $instance = new static;
        $decoded = $instance->resolveHashId()->decode($hashId);

        return $decoded[0] ?? null;
    }

    /**
     * Get the hash ID for this model.
     */
    public function getHashId(): string
    {
        return $this->resolveHashId()->encode($this->getKey());
    }

    /**
     * Accessor for the "hash_id" attribute.
     */
    public function hashId(): Attribute
    {
        return Attribute::make(get: fn () => $this->getHashId());
    }

    #[Scope]
    protected function whereHashIds(Builder $query, string|array|Collection $hashId): Builder
    {
        $hashes = is_string($hashId) ? [$hashId] : ($hashId instanceof Collection ? $hashId->all() : $hashId);

        $hashids = $this->resolveHashId();
        $ids = array_filter(array_map(
            fn (string $hash): ?int => $hashids->decode($hash)[0] ?? null,
            $hashes,
        ));

        if (empty($ids)) {
            return $query;
        }

        return count($ids) === 1
            ? $query->where($this->getKeyName(), reset($ids))
            : $query->whereIn($this->getKeyName(), $ids);
    }
}
