<?php

namespace Modules\Web\Adapters\Outbound\persistence\Repositories;

use Illuminate\Support\Facades\Cache;
use Modules\Web\Adapters\Outbound\persistence\Models\EloquentRefreshToken;
use Modules\Web\Adapters\Outbound\persistence\Models\EloquentUser;

class EloquentRefreshTokenRepository extends EloquentRepository
{
    public function __construct()
    {
        parent::__construct(new EloquentRefreshToken());
        //        $this->model->setConnection('default');
    }

    public function findByToken($token)
    {
        return $this->model
            ->select([
                'refresh_tokens.*',
                'users.id as user_id',
                'users.username as username',
                'users.email as email',
                'users.token_version',
            ])
            ->join('users', 'refresh_tokens.user_id', '=', 'users.id')
            ->where('token', $token)
            ->first();
    }
}
