<?php

namespace Modules\AuthApplication\Application\Ports\Inbound;

use Modules\AuthApplication\Domain\User;

interface AuthCommandPort
{
    public function login(string $username, string $plainPassword) :bool;
}
