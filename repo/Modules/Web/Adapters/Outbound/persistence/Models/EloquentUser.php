<?php

namespace Modules\Web\Adapters\Outbound\persistence\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    protected $table   = 'users';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'fullName',
        'email',
        'password'
    ];
}
