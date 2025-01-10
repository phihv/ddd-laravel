<?php

namespace Modules\AuthApplication\Application\UseCases;

use Illuminate\Validation\UnauthorizedException;
use Modules\AuthApplication\Application\Ports\Inbound\AuthPort;
use Modules\AuthApplication\Domain\AuthDomainService;
use Modules\AuthApplication\Domain\AccessToken;
use Modules\AuthApplication\Domain\TokenRepositoryPort;
use Modules\AuthApplication\Domain\User;
use Modules\AuthApplication\Domain\UserDomainService;
use Modules\AuthApplication\Domain\UserRepositoryPort;

class AuthAppService implements AuthPort
{
    public function __construct(
        private UserRepositoryPort  $userRepositoryPort,
        private TokenRepositoryPort $jwtRepositoryPort,
        private AuthDomainService   $authDomainService,
    )
    {
    }

    public function login(string $username, string $plainPassword, array $deviceInfo) :?array
    {
        return $this->authDomainService->getTokens($username, $plainPassword, $deviceInfo);
    }

    public function introspect(string $token): ?AccessToken
    {
        // TODO: Implement introspect() method.
        return $this->jwtRepositoryPort->decodeAccessToken($token);
    }

    public function checkPermission(int $userId, string $permission): bool
    {
        // TODO: Implement checkPermission() method.
        return $this->authDomainService->checkPermission($userId, $permission);
    }
}
