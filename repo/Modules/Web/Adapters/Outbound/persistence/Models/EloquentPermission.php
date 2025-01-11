<?php

namespace Modules\Web\Adapters\Outbound\persistence\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class EloquentPermission extends Model
{
    protected $table = 'permissions';
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

    public function roles()
    {
        return $this->belongsToMany(EloquentRole::class, 'role_permissions', 'permission_id', 'role_id');
    }

}
