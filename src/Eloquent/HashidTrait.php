<?php

namespace Vinkla\Hashids\Eloquent;

trait HashidTrait
{
    /**
     * {@inheritdoc}
     */
    public function getHashidAttribute()
    {
        return app('hashids')->encode($this->getKey());
    }

    /**
     * {@inheritdoc}
     */
    public static function findHashid(string $hashid, bool $multiple = false)
    {
        $ids = app('hashids')->decode($hashid);
        if ($multiple) {
            return self::find($ids);
        }
        if (count($ids) !== 1) {
            return;
        }

        return self::find($ids[0]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findHashidOrFail(string $hashid, bool $multiple = false)
    {
        $ids = app('hashids')->decode($hashid);
        if ($multiple) {
            return self::findOrFail($ids);
        }
        if (count($ids) !== 1) {
            throw new \InvalidArgumentException(
                'Expected a hashid encoding exactly one integer'
            );
        }

        return self::findOrFail($ids[0]);
    }
}
