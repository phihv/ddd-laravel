<?php

namespace Modules\AuthApplication\Domain;


interface UserRepositoryPort
{
    public function findByUsername(string $username) :?User;
    public function getPermissionsByUserId(int $userId) :?array;
    public function findById(int $id) :?User;
    public function save(User $user) :void;
}
