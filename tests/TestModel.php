<?php

namespace Vinkla\Tests\Hashids;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Traits\Hashidable;

class TestModel extends Model
{
    use Hashidable;
}
