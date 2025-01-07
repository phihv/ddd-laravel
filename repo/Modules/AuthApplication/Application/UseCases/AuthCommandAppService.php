<?php

namespace Modules\AuthApplication\Application\UseCases;

use Modules\AuthApplication\Application\Ports\Inbound\AuthCommandPort;
use Modules\AuthApplication\Domain\JWTClaimSet;
use Modules\AuthApplication\Domain\JWTRepositoryPort;
use Modules\AuthApplication\Domain\User;
use Modules\AuthApplication\Domain\UserDomainService;
use Modules\AuthApplication\Domain\UserRepositoryPort;

class AuthCommandAppService implements AuthCommandPort
{
    public function __construct(
        private UserRepositoryPort $userRepositoryPort,
        private JWTRepositoryPort  $jwtRepositoryPort,
//        private UserDomainService $userDomainService,
    )
    {
    }

    public function login(string $username, string $plainPassword) :?string
    {
        // TODO: Implement login() method.
        $user = $this->userRepositoryPort->findByUsername($username);
        $claims = new JWTClaimSet(subject: $user->getEmail());
        if ($user->verifyPassword($plainPassword)) {
            return $this->jwtRepositoryPort->generateToken($claims->toArray());
        }
        return null;
    }

    public function introspect(string $token): ?array
    {
        // TODO: Implement introspect() method.
        return $this->jwtRepositoryPort->decodeToken($token);
    }
}
