<?php
namespace Vinkla\Hashids\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait HashId
{
    protected function getHashIdField()
    {
        return config('hashids.hash_id_field');
    }

    protected static function bootUsesHashId()
    {
        static::saving(function($model) {
            $model->setAttribute($model->getHashIdField(), Hashids::encode($model->getKey()));
        });
    }

    public function getRouteKeyName()
    {
        return $this->getHashIdField();
    }
}