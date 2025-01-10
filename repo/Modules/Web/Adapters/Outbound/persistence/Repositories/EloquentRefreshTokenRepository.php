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
}
