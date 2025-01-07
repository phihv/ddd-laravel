<?php

namespace Modules\AuthApplication\Domain;

use Arr;

class Role
{
    public function __construct(
        private ? int $id,
        private ? string $name,
        private ? string $description,
        private ? array $permissions
    )
    {
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
