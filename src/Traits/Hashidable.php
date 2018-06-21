<?php

declare (strict_types = 1);

namespace Vinkla\Hashids\Traits;

use Vinkla\Hashids\Facades\Hashids;

/**
 * This is the Hashidable trait class.
 *
 * @author Rohan Sakhale <rs@saiashirwad.com>
 */
trait Hashidable
{

    /**
     * Encode key's directly for specific to calling {ModelClass}.
     *
     * @example
     *      \Vinkla\Tests\Hashids\TestModel::encodeKey($key)
     *
     * @param $key
     */
    public function scopeEncodeKey($query, $key)
    {
        return Hashids::connection(get_called_class())->encode($key);
    }

    /**
     * Decode provided hash into proper value using calling {ModelClass}.
     *
     * @example
     *      \Vinkla\Tests\Hashids\TestModel::decodeKey($hash)
     *
     * @param $hash
     */
    public function scopeDecodeKey($query, $hash)
    {
        return Hashids::connection(get_called_class())->decode($hash)[0] ?? false;
    }

    /**
     * Short hand method to directly find {ModelObject] by Hashed Key.
     *
     * @example
     *      \Vinkla\Tests\Hashids\TestModel::findByKey($hash)
     *
     * @param $query
     * @param $hash
     *
     * @return
     *      \Vinkla\Tests\Hashids\TestModel|null
     */
    public function scopeFindByKey($query, $hash)
    {
        $id = $this->scopeDecodeKey($query, $hash);
        if ($id) {
            return $this->find($id);
        } else {
            return;
        }
    }

    /**
     * Get Hashed key for \Vinkla\Tests\Hashids\TestModel.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->encodeKey($this->getKey());
    }

    /**
     * Get the route key directly as attribute for {ModelObject].
     *
     * @example
     *      $model->route_key
     *
     * @return mixed
     */
    public function getRouteKeyAttribute()
    {
        return $this->getRouteKey();
    }

    /**
     *  Get the URL by resource route mechanism.
     *
     * @param $mode - should be supported by the resourcde route
     *
     * @return string link
     */
    public function getRoute($mode)
    {
        return route($this->getTable() . '.' . $mode, [
            str_singular($this->getTable()) => $this->getRouteKey(),
        ]);
    }

    /**
     * Short hand mechanism to generate show route URL for {ModelObject].
     *
     * @example
     *      $model->show_route  // /models/{route_key}
     *
     * @return mixed
     */
    public function getShowRouteAttribute()
    {
        return $this->getRoute('show');
    }

    /**
     * Short hand mechanism to generate edit route URL for {ModelObject].
     *
     * @example
     *      $model->show_route  // /models/{route_key}/edit
     *
     * @return mixed
     */
    public function getEditRouteAttribute()
    {
        return $this->getRoute('edit');
    }

    /**
     * @return mixed
     */
    public function toClass()
    {
        return $this->getTable();
    }
}
