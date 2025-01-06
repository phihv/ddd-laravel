<?php

namespace Modules\AuthApplication\Application\UseCases;

use Modules\AuthApplication\Application\Ports\Inbound\AuthCommandPort;
use Modules\AuthApplication\Domain\JwtClaims;
use Modules\AuthApplication\Domain\JwtRepositoryPort;
use Modules\AuthApplication\Domain\User;
use Modules\AuthApplication\Domain\UserDomainService;
use Modules\AuthApplication\Domain\UserRepositoryPort;

class AuthCommandAppService implements AuthCommandPort
{
    public function __construct(
        private UserRepositoryPort $userRepositoryPort,
        private JwtRepositoryPort $jwtRepositoryPort,
//        private UserDomainService $userDomainService,
    )
    {
    }

    public function login(string $username, string $plainPassword) :?string
    {
        // TODO: Implement login() method.
        $user = $this->userRepositoryPort->findByUsername($username);
        $claims = new JwtClaims();
        if ($user->verifyPassword($plainPassword)) {
            return $this->jwtRepositoryPort->generateToken($claims->toArray());
        }
        return null;
    }
}
