<?php

namespace Modules\Web\app\Services\Auth;

use Modules\AuthApplication\Application\Ports\Inbound\UserCommandPort;

class UserService
{
    public function __construct(private readonly UserCommandPort $userCommandPort)
    {
    }
    public function create($params) :void {
        throw new \Exception('not implemented');
        $this->userCommandPort->create($params);
    }
}
