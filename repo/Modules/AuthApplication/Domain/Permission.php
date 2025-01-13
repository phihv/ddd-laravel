<?php

namespace Modules\AuthApplication\Domain;

use Modules\Shared\Exception\AppException;
use Modules\Shared\Exception\ErrorCode;
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
}
