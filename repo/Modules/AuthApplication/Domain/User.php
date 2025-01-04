<?php

namespace Modules\AuthApplication\Domain;

use DateTime;

class User
{
    public function __construct(
        private ? string $username = '',
        private ? Email $email = null,
        private ? string $password = null,
        private ? string $fullName = null,
    )
    {
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getEmail(): ?Email
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }


    public function getFullName(): ?string
    {
        return $this->fullName;
    }


}
