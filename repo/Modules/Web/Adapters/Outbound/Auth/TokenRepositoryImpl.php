<?php

namespace Modules\Web\Adapters\Outbound\Auth;

use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Support\Facades\Cache;
use Modules\AuthApplication\Domain\AccessToken;
use Modules\AuthApplication\Domain\TokenRepositoryPort;
use Modules\Shared\Exception\AppException;
use Modules\Shared\Exception\ErrorCode;
use Modules\Web\Adapters\Outbound\persistence\Repositories\EloquentRefreshTokenRepository;
use stdClass;

class TokenRepositoryImpl implements TokenRepositoryPort
{
    private string $secretKey;
    private string $algorithm;

    public function __construct()
    {
        $this->secretKey = env('JWT_SECRET');
        $this->algorithm = env('JWT_ALGORITHM', 'HS256');
    }

    public function generateAccessToken(array $claims): ?string
    {
        // TODO: Implement generateToken() method.
        return JWT::encode($claims, $this->secretKey, $this->algorithm);
    }

    /**
     * @throws AppException
     */
    public function decodeAccessToken(string $token): ?AccessToken
    {
        // TODO: Implement decodeToken() method.
        try {
            if (empty($token)) {
                return null;
            }
            $headers = new stdClass();
            $decoded = JWT::decode($token, new Key($this->secretKey, $this->algorithm), $headers);
            return AccessToken::createFromArray((array)$decoded);
        } catch (ExpiredException $e) {
            throw new AppException(ErrorCode::ACCESS_TOKEN_EXPIRED);
        } catch (SignatureInvalidException $e) {
            throw new AppException(ErrorCode::ACCESS_TOKEN_SIGNATURE_INVALID);
        } catch (Exception $e) {
            throw new AppException(ErrorCode::ACCESS_TOKEN_INVALID);
        }

    }

    public function storeRefreshToken(array $tokenData): void
    {
        resolve(EloquentRefreshTokenRepository::class)->create($tokenData);
    }

    public function getInfoRefreshToken(string $hashedRefreshToken)
    {
        return resolve(EloquentRefreshTokenRepository::class)->findByToken($hashedRefreshToken);
    }
}
