<?php

namespace Modules\AuthApplication\Application\Ports\Inbound;

use Modules\AuthApplication\Domain\AccessToken;

interface AuthorizationPort
{
    public function login(string $username, string $plainPassword, array $deviceInfo) :?array;
    public function refreshAccessToken(string $refreshToken, array $deviceInfo) :?array;
    public function introspect(string $token) :?AccessToken;
}
