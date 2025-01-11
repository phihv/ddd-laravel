<?php

namespace Modules\AuthApplication\Application\Ports\Inbound;


interface AuthenticatorPort
{
    public function createRole(array $data) :void;
    public function createPermission(array $data) :void;
    public function addUserRole(int $userId, int $roleId) :void;
    public function addRolePermission(int $roleId, int $permissionId) :void;
    public function removeUserRole(int $userId, int $roleId) :void;
    public function removeRolePermission(int $roleId, int $permissionId) :void;
    public function updateRole(int $id, array $dataUpdate): void;
    public function updatePermission(int $id, array $dataUpdate): void;
    public function deleteRole(int $id): void;
    public function deletePermission(int $id): void;
    public function checkPermission(int $userId, string $permission) :bool;
}
