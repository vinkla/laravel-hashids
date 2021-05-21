<?php

namespace Vinkla\Tests\Hashids\Mocks;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Traits\Hashidable;

class FooModel extends Model
{
    protected $table = 'foos';

    use Hashidable;
}
