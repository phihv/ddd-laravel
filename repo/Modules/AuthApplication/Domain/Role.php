<?php

namespace Modules\AuthApplication\Domain;

use Arr;
use Modules\Shared\Exception\AppException;
use Modules\Shared\Exception\ErrorCode;
use Modules\Shared\Traits\EntityTrait;

class Role
{
    use EntityTrait;
    public function __construct(
        private ? int $id = null,
        private ? string $name = null,
        private ? string $description = null,
        private ? array $permissions = null,
    )
    {
        if (empty($this->name)) {
            throw new AppException(ErrorCode::REQUIRE_NOT_NULL, "name");
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPermissions(): ?array
    {
        return $this->permissions;
    }

    public function addPermission(int|array $per): void
    {
        $this->permissions = array_unique(array_merge($this->permissions, Arr::wrap($per)));
    }

    public function removePermission(int|array $per): void
    {
        $this->permissions = array_unique(array_intersect($this->permissions, Arr::wrap($per)));
    }

}
