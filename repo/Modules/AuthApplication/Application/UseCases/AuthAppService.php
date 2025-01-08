<?php

namespace Modules\AuthApplication\Application\UseCases;

use Modules\AuthApplication\Application\Ports\Inbound\AuthPort;
use Modules\AuthApplication\Domain\AuthDomainService;
use Modules\AuthApplication\Domain\JWTClaimSet;
use Modules\AuthApplication\Domain\JWTRepositoryPort;
use Modules\AuthApplication\Domain\User;
use Modules\AuthApplication\Domain\UserDomainService;
use Modules\AuthApplication\Domain\UserRepositoryPort;

class AuthAppService implements AuthPort
{
    public function __construct(
        private UserRepositoryPort $userRepositoryPort,
        private JWTRepositoryPort  $jwtRepositoryPort,
        private AuthDomainService $authDomainService,
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

    public function introspect(string $token): ?JWTClaimSet
    {
        // TODO: Implement introspect() method.
        return $this->jwtRepositoryPort->decodeToken($token);
    }

    public function checkPermission(int $userId, string $permission): bool
    {
        // TODO: Implement checkPermission() method.
        return $this->authDomainService->checkPermission($userId, $permission);
    }
}
