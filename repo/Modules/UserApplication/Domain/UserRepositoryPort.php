<?php

namespace Modules\UserApplication\Domain;

interface UserRepositoryPort
{
    public function create(User $user) :void;
}
