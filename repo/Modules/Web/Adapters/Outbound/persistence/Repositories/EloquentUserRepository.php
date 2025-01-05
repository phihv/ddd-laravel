<?php

namespace Modules\Web\Adapters\Outbound\persistence\Repositories;

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
}
