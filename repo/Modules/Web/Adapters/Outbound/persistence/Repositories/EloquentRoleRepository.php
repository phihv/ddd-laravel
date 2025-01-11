<?php

namespace Modules\Web\Adapters\Outbound\persistence\Repositories;

use Modules\Web\Adapters\Outbound\persistence\Models\EloquentRole;

class EloquentRoleRepository extends EloquentRepository
{
    public function __construct()
    {
        parent::__construct(new EloquentRole());
        //        $this->model->setConnection('default');
    }


}
