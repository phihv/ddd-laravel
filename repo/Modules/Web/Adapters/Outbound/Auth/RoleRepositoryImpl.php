<?php

namespace Modules\Web\Adapters\Outbound\Auth;

use Modules\AuthApplication\Domain\Role;
use Modules\AuthApplication\Domain\RoleRepositoryPort;
use Modules\Shared\Exception\AppException;
use Modules\Shared\Exception\ErrorCode;
use Modules\Web\Adapters\Outbound\persistence\Repositories\EloquentRoleRepository;

readonly class RoleRepositoryImpl implements RoleRepositoryPort
{
    public function __construct(private EloquentRoleRepository $roleRepository)
    {
    }

    public function findById(int $id): ?Role
    {
        $role = $this->roleRepository->find($id);
        if (empty($role->id)) {
            throw new AppException(ErrorCode::DATA_NOT_FOUND);
        }
        return Role::createFromArray($role->toArray());
    }

    public function save(Role $role): void
    {
        $this->roleRepository->create($role->toArray());
    }

    public function update(Role $role): void
    {
        $this->roleRepository->update($role->getId(), $role->toArray());
    }
}
