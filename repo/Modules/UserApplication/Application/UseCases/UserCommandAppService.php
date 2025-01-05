<?php

namespace Modules\UserApplication\Application\UseCases;

use Modules\UserApplication\Application\Ports\Inbound\UserCommandPort;
use Modules\UserApplication\Domain\Email;
use Modules\UserApplication\Domain\User;
use Modules\UserApplication\Domain\UserRepositoryPort;

readonly class UserCommandAppService implements UserCommandPort
{
    public function __construct(
        private UserRepositoryPort $userRepositoryPort,
    )
    {
    }

    public function create($params): User
    {
        // TODO: Implement create() method.
        $user = new User(
            username: $params['username'],
            email: new Email($params['email']),
            fullName: $params['fullName']
        );
        $user->setPassword($params['password']);
        $this->userRepositoryPort->create($user);
        return $user;
    }
}
