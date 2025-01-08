<?php

namespace Modules\Web\app\Services\Auth;

use Modules\AuthApplication\Application\Ports\Inbound\AuthPort;
use Modules\AuthApplication\Domain\JWTClaimSet;

class AuthService
{
    public function __construct(private readonly AuthPort $authCommandPort)
    {
    }

    public function login($request): ?string
    {
        return $this->authCommandPort->login($request['username'] ?? '', $request['password'] ?? '');
    }

    public function introspect($token): ?JWTClaimSet
    {
        return $this->authCommandPort->introspect($token);
    }

    public function checkPermission(int $userId, string $permission)
    {
        return $this->authCommandPort->checkPermission($userId, $permission);
    }
}
