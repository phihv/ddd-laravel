<?php

namespace Modules\AuthApplication\Domain;


interface PermissionRepositoryPort
{
    public function findById(int $id) :?Permission;
    public function save(Permission $permission) :void;
    public function update(Permission $permission) :void;
    public function delete(int $id) :void;
}
