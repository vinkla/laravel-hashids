<?php

declare(strict_types=1);

namespace Vinkla\Tests\Hashids\Concerns;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Concerns\HasHashId;

class FakeModelWithCustomConnection extends Model
{
    use HasHashId;

    protected string $connectionHashId = 'custom';

    protected $guarded = [];
}
