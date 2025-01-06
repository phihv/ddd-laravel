<?php

namespace Modules\AuthApplication\Application\Ports\Inbound;

interface AuthCommandPort
{
    public function login(string $username, string $plainPassword) :?string;
}
