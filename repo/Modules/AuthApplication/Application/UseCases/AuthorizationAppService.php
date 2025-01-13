<?php

namespace Modules\AuthApplication\Application\UseCases;

use Illuminate\Validation\UnauthorizedException;
use Modules\AuthApplication\Application\Ports\Inbound\AuthorizationPort;
use Modules\AuthApplication\Domain\AccessToken;
use Modules\AuthApplication\Domain\AuthDomainService;
use Modules\AuthApplication\Domain\RefreshToken;
use Modules\AuthApplication\Domain\TokenRepositoryPort;
use Modules\AuthApplication\Domain\UserRepositoryPort;


readonly class AuthorizationAppService implements AuthorizationPort
{
    public function __construct(
        private UserRepositoryPort       $userRepositoryPort,
        private TokenRepositoryPort      $tokenRepositoryPort,
        private AuthDomainService        $authDomainService,
    )
    {
    }

    public function login(string $username, string $plainPassword, array $deviceInfo): ?array
    {
        $user = $this->userRepositoryPort->findByUsername($username);
        if (!$user->verifyPassword($plainPassword)) {
            throw new UnauthorizedException();
        }
        $accessToken = new AccessToken(subject: $user->getEmail());
        $refreshToken = new RefreshToken(
            userId: $user->getId(),
            device: $deviceInfo['name'] ?? '',
            ip: $deviceInfo['ip'] ?? '',
            version: $user->getTokenVersion()
        );

        $accessToken->setToken($this->tokenRepositoryPort->generateAccessToken($accessToken->toArray()));
        $this->tokenRepositoryPort->storeRefreshToken($refreshToken->toStoreData());

        return [
            'accessToken' => $accessToken->toResponseData(),
            'refreshToken' => $refreshToken->toResponseData(),
        ];
    }

    public function refreshAccessToken(string $refreshToken, array $deviceInfo): ?array
    {
        $user = $this->authDomainService->getUserByRefreshToken($refreshToken, $deviceInfo);
        $accessToken = new AccessToken(subject: $user->getEmail());
        $accessToken->setToken($this->tokenRepositoryPort->generateAccessToken($accessToken->toArray()));
        return $accessToken->toResponseData();
    }

    public function introspect(string $token): ?AccessToken
    {
        return $this->tokenRepositoryPort->decodeAccessToken($token);
    }
}
