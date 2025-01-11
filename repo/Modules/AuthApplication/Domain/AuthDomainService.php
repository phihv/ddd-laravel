<?php

namespace Modules\AuthApplication\Domain;

use Illuminate\Validation\UnauthorizedException;
use Modules\Shared\Exception\AppException;
use Modules\Shared\Exception\ErrorCode;
use Random\RandomException;

readonly class AuthDomainService
{
    public function __construct(
        private UserRepositoryPort  $userRepositoryPort,
        private TokenRepositoryPort $tokenRepositoryPort
    )
    {
    }

    public function checkPermission(int $userId, string $permission): bool {
        $permissions = $this->userRepositoryPort->getPermissionsByUserId($userId);
        return in_array($permission, $permissions, true);
    }

    /**
     * @throws AppException
     */
    public function getUserByRefreshToken(string $refreshToken, array $deviceInfo): User
    {
        $refreshToken = new RefreshToken(
            device: $deviceInfo['name'] ?? '',
            ip: $deviceInfo['ip'] ?? '',
            token: $refreshToken
        );
        $record = $this->tokenRepositoryPort->getInfoRefreshToken($refreshToken->getHashedToken());
        if (
            empty($record) ||
            empty($record['expires_at']) ||
            empty($record['email']) ||
            $record['device'] !== $refreshToken->getDevice() ||
            $record['ip'] !== $refreshToken->getIp() ||
            $record['version'] !== $record['token_version']
        ) {
            throw new AppException(ErrorCode::REFRESH_TOKEN_INVALID);
        }
        $refreshToken->setExpiresAt($record['expires_at']);
        if ($refreshToken->isExpired()) {
            throw new AppException(ErrorCode::REFRESH_TOKEN_EXPIRED);
        }
        return new User(
            id: $record['user_id'],
            username: $record['username'],
            email: $record['email'],
            token_version: $record['token_version']
        );
    }
}
