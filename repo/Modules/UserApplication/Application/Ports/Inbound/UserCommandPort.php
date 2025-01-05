<?php

namespace Modules\UserApplication\Application\Ports\Inbound;

use Modules\UserApplication\Domain\User;

interface UserCommandPort
{
    public function create($params) :User;
}
