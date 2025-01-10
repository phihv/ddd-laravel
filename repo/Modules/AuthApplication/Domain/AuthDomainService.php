<?php

namespace Modules\AuthApplication\Domain;

use Illuminate\Validation\UnauthorizedException;
use Random\RandomException;

readonly class AuthDomainService
{
    public function __construct(
        private UserRepositoryPort $userRepositoryPort,
        private TokenRepositoryPort $tokenRepositoryPort
    )
    {
    }

    /**
     * @throws RandomException
     */
    public function getTokens(string $username, string $plainPassword, array $deviceInfo)
    {
        $user = $this->userRepositoryPort->findByUsername($username);
        if (!$user->verifyPassword($plainPassword)) {
            throw new UnauthorizedException();
        }
        $accessToken = new AccessToken(subject: $user->getEmail());
        $accessToken->toResponseData($this->tokenRepositoryPort);

        $refreshToken = new RefreshToken(userId: $user->getId(), device: $deviceInfo['name'] ?? '', ip: $deviceInfo['ip'] ?? '');
        $this->tokenRepositoryPort->storeRefreshToken($refreshToken->toStoreData());

        return [
            'accessToken' => $accessToken->toResponseData($this->tokenRepositoryPort),
            'refreshToken' => $refreshToken->toResponseData(),
        ];
    }

    public function checkPermission(int $userId, string $permission): bool {
        $permissions = $this->userRepositoryPort->getPermissionsByUserId($userId);
        return in_array($permission, $permissions, true);
    }
}
