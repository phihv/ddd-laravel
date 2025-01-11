<?php

namespace Modules\Web\Adapters\Outbound\persistence\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class EloquentRefreshToken extends Authenticatable
{
    protected $table   = 'refresh_tokens';
    public $timestamps = false;
    protected $guarded = [];
}
