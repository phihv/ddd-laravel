<?php

namespace Modules\AuthApplication\Domain;


interface RoleRepositoryPort
{
    public function findById(int $id) :?Role;
    public function save(Role $role) :void;
    public function update(Role $role) :void;
}
