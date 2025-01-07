<?php

namespace Modules\Web\Adapters\Outbound\persistence\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class EloquentPermission extends Authenticatable
{
    protected $table = 'permissions';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'fullName',
        'email',
        'password'
    ];

    public function roles()
    {
        return $this->belongsToMany(EloquentRole::class, 'role_permissions', 'permission_id', 'role_id');
    }

}
