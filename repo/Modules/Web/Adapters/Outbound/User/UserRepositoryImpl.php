<?php

namespace Modules\Web\Adapters\Outbound\User;

use Modules\UserApplication\Domain\User;
use Modules\UserApplication\Domain\UserRepositoryPort;
use Modules\Web\Adapters\Outbound\persistence\Repositories\EloquentUserRepository;

class UserRepositoryImpl implements UserRepositoryPort
{
    public function __construct(private readonly EloquentUserRepository $userRepository)
    {
    }

    public function create(User $user): void
    {
        // TODO: Implement create() method.
        $this->userRepository->create($this->toUserArr($user));
    }

    private function toUserArr(User $user): array
    {
        return [
            'username' => $user->getUsername(),
            'fullName' => $user->getFullName(),
            'password' => $user->getPassword(),
            'email' => $user->getEmail()->getEmail(),
        ];
    }
}
