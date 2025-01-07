<?php

namespace Modules\Web\Adapters\Outbound\persistence\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class EloquentRole extends Authenticatable
{
    protected $table   = 'roles';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'fullName',
        'email',
        'password'
    ];

    public function users()
    {
        return $this->belongsToMany(EloquentUser::class, 'user_roles', 'role_id', 'user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(EloquentPermission::class, 'role_permissions', 'role_id', 'permission_id');
    }

}
