<?php

namespace Modules\AuthApplication\Application\Ports\Inbound;

use Modules\AuthApplication\Domain\JWTClaimSet;

interface AuthCommandPort
{
    public function login(string $username, string $plainPassword) :?string;
    public function introspect(string $token) :?JWTClaimSet;
}
