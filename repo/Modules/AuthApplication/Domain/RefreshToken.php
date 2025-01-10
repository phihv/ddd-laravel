<?php

namespace Modules\AuthApplication\Domain;

use Modules\Shared\Exception\AppException;
use Random\RandomException;

class RefreshToken
{
    private string $hashedToken = '';

    public function __construct(
        private ?int    $userId = null,
        private ?string $device = null,
        private ?string $ip = null,
        private ?string $tokenType = 'Bearer',
        private ?string $token = null,
        private ?int    $version = null,
        private ?int    $expiresAt = null,
    )
    {
        $this->token = $this->token ?? $this->generateToken();
        $this->expiresAt = $expires_at ?? time() + config('token.refresh_token_lifetime');
        $this->setHashedToken();
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setExpiresAt(?int $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    public function getDevice(): ?string
    {
        return $this->device;
    }


    private function generateToken(): string
    {
        try {
            return bin2hex(random_bytes(40));
        } catch (RandomException $e) {
        }
    }

    private function setHashedToken(): void
    {
        $this->hashedToken = hash_hmac('sha256', $this->token, env('APP_KEY'));
    }

    public function getHashedToken(): string
    {
        return $this->hashedToken;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function isExpired(): bool
    {
        return time() > $this->expiresAt;
    }

    public function isValid()
    {

    }

    public function toStoreData()
    {
        return [
            'user_id' => $this->userId,
            'token_type' => $this->tokenType,
            'device' => $this->device,
            'ip' => $this->ip,
            'token' => $this->hashedToken,
            'expires_at' => $this->expiresAt,
        ];
    }

    public function toResponseData()
    {
        return [
            'userId' => $this->userId,
            'token' => $this->token,
            'tokenType' => $this->tokenType,
            'expiresAt' => $this->expiresAt
        ];
    }
}
