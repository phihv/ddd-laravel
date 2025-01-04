<?php

namespace Modules\AuthApplication\Application\UseCases;

use Modules\AuthApplication\Application\Ports\Inbound\UserCommandPort;
use Modules\AuthApplication\Domain\Email;
use Modules\AuthApplication\Domain\User;
use Modules\AuthApplication\Domain\UserRepositoryPort;

readonly class UserCommandAppService implements UserCommandPort
{
    public function __construct(private UserRepositoryPort $userRepositoryPort)
    {
    }

    public function create($params): void
    {
        // TODO: Implement create() method.
        $user = new User(
            username: $params['username'],
            email: new Email($params['email']),
            password: $params['password'],
            fullName: $params['fullName']
        );
        $this->userRepositoryPort->create($user);
    }
}
