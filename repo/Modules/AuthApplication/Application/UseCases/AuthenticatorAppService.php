<?php

namespace Modules\AuthApplication\Application\UseCases;

use Modules\AuthApplication\Application\Ports\Inbound\AuthenticatorPort;
use Modules\AuthApplication\Domain\AuthDomainService;
use Modules\AuthApplication\Domain\Permission;
use Modules\AuthApplication\Domain\PermissionRepositoryPort;
use Modules\AuthApplication\Domain\Role;
use Modules\AuthApplication\Domain\RoleRepositoryPort;
use Modules\AuthApplication\Domain\UserRepositoryPort;


readonly class AuthenticatorAppService implements AuthenticatorPort
{
    public function __construct(
        private UserRepositoryPort       $userRepositoryPort,
        private RoleRepositoryPort       $roleRepositoryPort,
        private PermissionRepositoryPort $permissionRepositoryPort,
        private AuthDomainService        $authDomainService,
    )
    {
    }

    public function checkPermission(int $userId, string $permission): bool
    {
        return $this->authDomainService->checkPermission($userId, $permission);
    }


    public function createRole(array $data): void
    {
        $role = Role::createFromArray($data);
        $this->roleRepositoryPort->save($role);
    }

    public function createPermission(array $data): void
    {
        $permission = new Permission(name: $data['name'] ?? '', description: $data['description'] ?? '');
        $this->permissionRepositoryPort->save($permission);
    }

    public function addUserRole(int $userId, int $roleId): void
    {
        $user = $this->userRepositoryPort->findById($userId, true);
        $user->addRole($roleId);
        $this->userRepositoryPort->save($user);
    }

    public function addRolePermission(int $roleId, int $permissionId): void
    {
        $role = $this->roleRepositoryPort->findById($roleId);
        $role->addPermission($permissionId);
        $this->roleRepositoryPort->save($role);
    }

    public function removeUserRole(int $userId, int $roleId): void
    {
        $user = $this->userRepositoryPort->findById($userId);
        $user->removeRole($roleId);
        $this->userRepositoryPort->save($user);
    }

    public function removeRolePermission(int $roleId, int $permissionId): void
    {
        $role = $this->roleRepositoryPort->findById($roleId);
        $role->removePermission($permissionId);
        $this->roleRepositoryPort->save($role);
    }

    public function updateRole(int $id, array $dataUpdate): void
    {
        $role = $this->roleRepositoryPort->findById($id);
        $role->update($dataUpdate);
        $this->roleRepositoryPort->update($role);
    }

    public function updatePermission(int $id, array $dataUpdate): void
    {
        $per = $this->permissionRepositoryPort->findById($id);
        $per->update($dataUpdate);
        $this->permissionRepositoryPort->update($per);
    }

    public function deleteRole(int $id): void
    {
        // TODO: Implement deleteRole() method.
    }

    public function deletePermission(int $id): void
    {
        // TODO: Implement deletePermission() method.
    }
}
