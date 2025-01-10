<?php

namespace Modules\AuthApplication\Domain;

class AccessToken
{
    private string $token;
    public function __construct(
        private ?string $issuer = null,
        private ?string $subject = null,
        private ?array  $audience = null,
        private ?int    $issuedAt = null,
        private ?int    $expiration = null,
        private ?int    $notBefore = null,
        private ?string $jwtId = null,
        private ?array  $customClaims = [],
    )
    {
        $this->issuer = $issuer ?? env('APP_URL');
//        $this->subject = $subject ?? 'phihv.soict@gmail.com';
        $this->audience = $audience ?? [env('APP_URL') . '/api'];
        $this->issuedAt = $issuedAt ?? time();
        $this->expiration = $expiration ?? $this->issuedAt + 3600;
        $this->notBefore = $notBefore ?? $this->issuedAt;
        $this->jwtId = $jwtId ?? uniqid('jwt_', true);
    }

    public function toResponseData(): array
    {
        return [
            'token' => $this->token,
            'tokenType' => 'Bearer',
            'expiresAt' => $this->expiration
        ];
    }

    public function setToken($token): void
    {
        $this->token = $token;

    }

    public function addClaim(string $key, mixed $value): void
    {
        $this->customClaims[$key] = $value;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function toArray(): array
    {
        return array_merge([
            'iss' => $this->issuer,
            'sub' => $this->subject,
            'aud' => $this->audience,
            'iat' => $this->issuedAt,
            'exp' => $this->expiration,
            'nbf' => $this->notBefore,
            'jti' => $this->jwtId,
        ], $this->customClaims);
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            issuer: $data['iss'],
            subject: $data['sub'],
            audience: $data['aud'],
            issuedAt: $data['iat'],
            expiration: $data['exp'],
            notBefore: $data['nbf'] ?? null,
            jwtId: $data['jti'] ?? null,
            customClaims: array_diff_key($data, array_flip(['iss', 'sub', 'aud', 'iat', 'exp', 'nbf', 'jti']))
        );
    }

}
