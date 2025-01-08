<?php

namespace Modules\Web\Adapters\Outbound\persistence\Repositories;

use Illuminate\Support\Facades\Cache;
use Modules\Web\Adapters\Outbound\persistence\Models\EloquentUser;

class EloquentUserRepository extends EloquentRepository
{
    public function __construct()
    {
        parent::__construct(new EloquentUser());
        //        $this->model->setConnection('default');
    }

    public function findByUsername($username, $select = '*')
    {
        return $this->model
            ->select($select)
            ->where('username', $username)
            ->first();
    }

    public function findByEmail(string $email, $select = '*')
    {
        return $this->model
            ->select($select)
            ->where('email', $email)
            ->first();
    }

    public function getPermissionsByUserId(int $userId)
    {
        $cacheKey = "user_permissions_{$userId}";

        $permissions = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($userId) {
            $user = $this->find($userId);

            if (!$user) {
                return [];
            }

            return $user->roles()
                ->with('permissions')
                ->get()
                ->pluck('permissions')
                ->flatten()
                ->pluck('name')
                ->unique()
                ->toArray();
        });
        return $permissions;
    }
}
