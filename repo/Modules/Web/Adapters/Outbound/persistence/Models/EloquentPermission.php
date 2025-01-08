<?php

namespace Modules\Web\Adapters\Outbound\persistence\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentPermission extends Model
{
    protected $table = 'permissions';

    public $timestamps = false;


    public function roles()
    {
        return $this->belongsToMany(EloquentRole::class, 'role_permissions', 'permission_id', 'role_id');
    }

}
