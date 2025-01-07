<?php

namespace Modules\AuthApplication\Domain;

class Permission
{
    public function __construct(
        private ? int $id,
        private ? string $name,
        private ? string $description,
    )
    {
    }
}
