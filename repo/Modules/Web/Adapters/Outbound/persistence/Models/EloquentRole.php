<?php

namespace Modules\Web\Adapters\Outbound\persistence\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentRole extends Model
{
    protected $table   = 'roles';

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(EloquentUser::class, 'user_roles', 'role_id', 'user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(EloquentPermission::class, 'role_permissions', 'role_id', 'permission_id');
    }

}
