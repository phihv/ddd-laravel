<?php

namespace Modules\AuthApplication\Domain;

use Arr;
use Modules\Shared\Traits\EntityTrait;
use Modules\Shared\Utils\PasswordHasher;


class User
{
    use EntityTrait;

    public function __construct(
        private ? int $id = null,
        private ? string $username = '',
        private ? string $email = null,
        private ? string $password = null,
        private ? int $token_version = null,
        private ? array $roles = null,
    )
    {
    }

    public function getTokenVersion(): ?int
    {
        return $this->token_version;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function verifyPassword(string $plainPassword): bool
    {
        return PasswordHasher::verify($plainPassword, $this->password);
    }

    public function addRole(int|array $role): void
    {
        $this->roles = array_unique(array_merge($this->roles, Arr::wrap($role)));
    }

    public function removeRole(int|array $role): void
    {
        $this->roles = array_unique(array_intersect($this->roles, Arr::wrap($role)));
    }

}
