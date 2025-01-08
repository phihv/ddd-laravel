<?php

namespace Modules\AuthApplication\Domain;

readonly class AuthDomainService
{
    public function __construct(
        private UserRepositoryPort $userRepositoryPort
    )
    {
    }

    public function checkPermission(int $userId, string $permission): bool {
        $permissions = $this->userRepositoryPort->getPermissionsByUserId($userId);
        return in_array($permission, $permissions, true);
    }
}
