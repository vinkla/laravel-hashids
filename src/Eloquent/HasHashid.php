<?php

namespace Vinkla\Hashids\Eloquent;

interface HasHashid
{
    /**
     * Get the hashid of this model.
     *
     * @return string
     */
    public function getHashidAttribute();

    /**
     * Find the model or models described by a given hashid.
     *
     * @param string $hashid The hashid to decode
     * @param bool $multiple If false (default) the hashid is expected to encode
     * a single integer, and a single matching model or null will be returned;
     * if it does not encode a single integer, null is returned. If true, an
     * array of IDs (possibly empty) is searched for, and an instance of
     * Illuminate\Database\Eloquent\Collection is returned.
     *
     * @return mixed
     */
    public static function findHashid(string $hashid, bool $multiple = false);

    /**
     * Find the model or models described by a given hashid or throw an
     * exception.
     *
     * @param string $hashid The hashid to decode
     * @param bool $multiple If false (default) the hashid is expected to encode
     * a single integer, and a single matching model will be returned; if it
     * does not encode a single integer, an \InvalidArgumentException is thrown.
     * If true, an array of IDs (possibly empty) is searched for, and an
     * instance of \Illuminate\Database\Eloquent\Collection is returned if all
     * members are found; otherwise, an
     * \Illuminate\Database\Eloquent\ModelNotFoundException is thrown.
     *
     * @return mixed
     */
    public static function findHashidOrFail(string $hashid, bool $multiple = false);
}
