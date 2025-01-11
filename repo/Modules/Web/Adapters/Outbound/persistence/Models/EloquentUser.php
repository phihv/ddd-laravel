<?php

namespace Modules\Web\Adapters\Outbound\persistence\Models;

use Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EloquentUser extends Authenticatable
{
    protected $table   = 'users';
    public $timestamps = false;
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(EloquentRole::class, 'user_roles', 'user_id', 'role_id');
    }
}
