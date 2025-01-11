<?php

namespace Modules\Web\Adapters\Outbound\Auth;

use Modules\AuthApplication\Domain\User;
use Modules\AuthApplication\Domain\UserRepositoryPort;
use Modules\Shared\Exception\AppException;
use Modules\Shared\Exception\ErrorCode;
use Modules\Web\Adapters\Outbound\persistence\Repositories\EloquentUserRepository;
use function PHPUnit\Framework\isEmpty;

readonly class UserRepositoryImpl implements UserRepositoryPort
{
    public function __construct(private EloquentUserRepository $userRepository)
    {
    }


    public function findByUsername(string $username): ?User
    {
        // TODO: Implement findByUsername() method.
        $user = $this->userRepository->findByUsername($username);
        if (!$user) {
            throw new AppException(ErrorCode::DATA_NOT_FOUND);
        }
        return User::createFromArray($user->toArray());
    }

    public function getPermissionsByUserId(int $userId): ?array
    {
        return $this->userRepository->getPermissionsByUserId($userId);
    }

    public function findById(int $id): ?User
    {
        $user = $this->userRepository->find($id);
        if (empty($user) || isEmpty($user)) {
            throw new AppException(ErrorCode::DATA_NOT_FOUND);
        }
        return User::createFromArray($user->toArray());
    }

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }
}
