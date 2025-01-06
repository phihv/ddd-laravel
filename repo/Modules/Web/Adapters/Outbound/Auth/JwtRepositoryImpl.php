<?php

namespace Modules\Web\Adapters\Outbound\Auth;

use Firebase\JWT\JWT;
use Modules\AuthApplication\Domain\JwtRepositoryPort;

class JwtRepositoryImpl implements JwtRepositoryPort
{
    private string $secretKey;
    private string $algorithm;
    public function __construct()
    {
        $this->secretKey = env('JWT_SECRET');
        $this->algorithm = env('JWT_ALGORITHM', 'HS256');
    }
    public function generateToken(array $claims): ?string
    {
        // TODO: Implement generateToken() method.
        return JWT::encode($claims, $this->secretKey, $this->algorithm);
    }

    public function decodeToken(string $token): ?string
    {
        // TODO: Implement decodeToken() method.
        return null;
    }

    public function invalidateToken(string $token): ?string
    {
        // TODO: Implement invalidateToken() method.
        return null;
    }
}
