<?php

namespace Modules\AuthApplication\Application\UseCases;

use Modules\AuthApplication\Application\Ports\Inbound\AuthCommandPort;
use Modules\AuthApplication\Domain\User;
use Modules\AuthApplication\Domain\UserDomainService;
use Modules\AuthApplication\Domain\UserRepositoryPort;

class AuthCommandAppService implements AuthCommandPort
{
    public function __construct(
        private UserRepositoryPort $userRepositoryPort,
        private UserDomainService $userDomainService,
    )
    {
    }

    public function login(string $username, string $plainPassword): bool
    {
        // TODO: Implement login() method.
        $user = $this->userRepositoryPort->findByUsername($username);
        return $user->verifyPassword($plainPassword);
    }
}
