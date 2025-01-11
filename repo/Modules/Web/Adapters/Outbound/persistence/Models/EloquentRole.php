<?php

namespace Modules\Web\Adapters\Outbound\persistence\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class EloquentRole extends Model
{
    protected $table   = 'roles';
    public $timestamps = false;
    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = Auth::user()->id;
        });
        static::updating(function ($model) {
            $model->modified_by = Auth::user()->id;
        });
    }

    public function users()
    {
        return $this->belongsToMany(EloquentUser::class, 'user_roles', 'role_id', 'user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(EloquentPermission::class, 'role_permissions', 'role_id', 'permission_id');
    }

}
