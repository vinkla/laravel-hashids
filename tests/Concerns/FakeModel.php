<?php

declare(strict_types=1);

namespace Vinkla\Tests\Hashids\Concerns;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Concerns\HasHashId;

class FakeModel extends Model
{
    use HasHashId;

    protected $guarded = [];
}
