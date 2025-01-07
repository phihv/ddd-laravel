<?php

namespace Modules\Web\Adapters\Outbound\Auth;

use Modules\AuthApplication\Domain\User;
use Modules\AuthApplication\Domain\UserRepositoryPort;
use Modules\Web\Adapters\Outbound\persistence\Repositories\EloquentUserRepository;

class UserRepositoryImpl implements UserRepositoryPort
{
    public function __construct(private readonly EloquentUserRepository $userRepository)
    {
    }

    public function findByUsername(string $username): ?User
    {
        // TODO: Implement findByUsername() method.
        $user = $this->userRepository->findByUsername($username);
        if (!$user) {
            return null;
        }
        return new User(
            id: $user->id,
            username: $user->username,
            email: $user->email,
            password: $user->password
        );
    }
}
