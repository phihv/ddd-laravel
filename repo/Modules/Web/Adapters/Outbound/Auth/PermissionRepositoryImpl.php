<?php

namespace Modules\Web\Adapters\Outbound\Auth;

use Modules\AuthApplication\Domain\Permission;
use Modules\AuthApplication\Domain\PermissionRepositoryPort;
use Modules\AuthApplication\Domain\Role;
use Modules\Shared\Exception\AppException;
use Modules\Shared\Exception\ErrorCode;
use Modules\Web\Adapters\Outbound\persistence\Repositories\EloquentPermissionRepository;
use function PHPUnit\Framework\isEmpty;

readonly class PermissionRepositoryImpl implements PermissionRepositoryPort
{
    public function __construct(private EloquentPermissionRepository $permissionRepository)
    {
    }

    public function findById(int $id): ?Permission
    {
        $per = $this->permissionRepository->find($id);
        if (empty($per->toArray())) {
            throw new AppException(ErrorCode::DATA_NOT_FOUND);
        }
        return Permission::createFromArray($per->toArray());
    }

    public function save(Permission $permission): void
    {
        $this->permissionRepository->create($permission->toArray());
    }

    public function update(Permission $permission): void
    {
        $this->permissionRepository->update($permission->getId(), $permission->toArray());
    }

    public function delete(int $id): void
    {
        // TODO: Implement delete() method.
    }
}
