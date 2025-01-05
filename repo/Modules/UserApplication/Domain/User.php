<?php

namespace Modules\UserApplication\Domain;

use Modules\Kernel\Utils\PasswordHasher;

class User
{
    public function __construct(
        private ? int $id = null,
        private ? string $username = '',
        private ? Email $email = null,
        private ? string $fullName = null,
        private ? string $password = null,
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getEmail(): ?Email
    {
        return $this->email;
    }

    public function setPassword(string $plainPassword): void
    {
        $this->password = PasswordHasher::hash($plainPassword);
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }
}
