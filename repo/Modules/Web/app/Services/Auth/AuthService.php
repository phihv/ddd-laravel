<?php

namespace Modules\Web\app\Services\Auth;

use Modules\AuthApplication\Application\Ports\Inbound\AuthCommandPort;

class AuthService
{
    public function __construct(private readonly AuthCommandPort $authCommandPort)
    {
    }

    public function login($request): ?string
    {
        return $this->authCommandPort->login($request['username'] ?? '', $request['password'] ?? '');
    }

    public function introspect($token): ?array
    {
        return $this->authCommandPort->introspect($token);
    }
}
