<?php

namespace Modules\Web\Adapters\Outbound\persistence\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class EloquentUser extends Authenticatable
{
    protected $table   = 'users';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'fullName',
        'email',
        'password'
    ];

    public function roles()
    {
        return $this->belongsToMany(EloquentRole::class, 'user_roles', 'user_id', 'role_id');
    }
}
