<?php

namespace Modules\AuthApplication\Domain;

use Modules\Shared\Traits\EntityTrait;

class Permission
{
    use EntityTrait;
    public function __construct(
        private ? int $id = null,
        private ? string $name = null,
        private ? string $description = null,
    )
    {
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
}
