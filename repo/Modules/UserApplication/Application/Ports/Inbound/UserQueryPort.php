<?php

namespace Modules\UserApplication\Application\Ports\Inbound;

use Modules\UserApplication\Domain\User;

interface UserQueryPort
{
    public function getInfoUserByEmail(string $email) :User;
}
