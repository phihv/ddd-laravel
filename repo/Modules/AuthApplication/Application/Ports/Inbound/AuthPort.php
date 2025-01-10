<?php

namespace Modules\AuthApplication\Application\Ports\Inbound;

use Modules\AuthApplication\Domain\AccessToken;

interface AuthPort
{
    public function login(string $username, string $plainPassword, array $deviceInfo) :?array;
    public function introspect(string $token) :?AccessToken;
    public function checkPermission(int $userId, string $permission) :bool;
}
