<?php

namespace Modules\Web\Adapters\Outbound\Auth;

use Modules\AuthApplication\Domain\User;
use Modules\AuthApplication\Domain\UserRepositoryPort;
use Modules\Shared\Exception\AppException;
use Modules\Shared\Exception\ErrorCode;
use Modules\Web\Adapters\Outbound\persistence\Repositories\EloquentUserRepository;

class UserRepositoryImpl implements UserRepositoryPort
{
    public function __construct(private readonly EloquentUserRepository $userRepository)
    {
    }

    /**
     * @throws AppException
     */
    public function findByUsername(string $username): ?User
    {
        // TODO: Implement findByUsername() method.
        $user = $this->userRepository->findByUsername($username);
        if (!$user) {
            throw new AppException(ErrorCode::DATA_NOT_FOUND);
        }
        return new User(
            id: $user->id,
            username: $user->username,
            email: $user->email,
            password: $user->password
        );
    }

    public function getPermissionsByUserId(int $userId): ?array
    {
        return $this->userRepository->getPermissionsByUserId($userId);
    }
}
