<?php

namespace Modules\AuthApplication\Domain;

interface UserRepositoryPort
{
    public function create(User $user) :void;
}
