<?php

namespace Modules\Web\app\Services\User;

use Modules\UserApplication\Application\Ports\Inbound\UserCommandPort;

class UserService
{
    public function __construct(private readonly UserCommandPort $userCommandPort)
    {
    }
    public function create($params) :array {
        $user = $this->userCommandPort->create($params);
        return [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail()->getEmail(),
            'fullName' => $user->getFullName(),
        ];
    }
}
