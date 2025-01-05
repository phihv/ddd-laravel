<?php

namespace Modules\AuthApplication\Domain;

use Modules\Kernel\Utils\PasswordHasher;
use Modules\UserApplication\Domain\Email;

class User
{
    public function __construct(
        private ? int $id = null,
        private ? string $username = '',
        private ? Email $email = null,
        private ? string $password = null,
    )
    {
    }

    public function verifyPassword(string $plainPassword): bool
    {
        return PasswordHasher::verify($plainPassword, $this->password);
    }

}
