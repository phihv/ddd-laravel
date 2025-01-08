<?php

namespace Modules\Web\Adapters\Outbound\persistence\Repositories;

use Modules\Web\Adapters\Outbound\persistence\Models\EloquentPermission;

class EloquentPermissionRepository extends EloquentRepository
{
    public function __construct()
    {
        parent::__construct(new EloquentPermission());
        //        $this->model->setConnection('default');
    }


}
