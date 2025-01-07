<?php

namespace Modules\Web\Adapters\Outbound\Auth;

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Modules\AuthApplication\Domain\JWTRepositoryPort;
use Modules\Kernel\Exception\AppException;
use Modules\Kernel\Exception\ErrorCode;
use stdClass;

class JWTRepositoryImpl implements JWTRepositoryPort
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

    /**
     * @throws AppException
     */
    public function decodeToken(string $token): ?array
    {
        // TODO: Implement decodeToken() method.
        try {
            if (empty($token)) {
                return null;
            }
            $headers = new stdClass();
            $decoded = JWT::decode($token, new Key($this->secretKey, $this->algorithm), $headers);
            return (array)$decoded;
        } catch (ExpiredException $e) {
            throw new AppException(ErrorCode::JWT_EXPIRED_EXCEPTION);
        } catch (SignatureInvalidException $e) {
            throw new AppException(ErrorCode::JWT_SIGNATURE_INVALID_EXCEPTION);
        } catch (\Exception $e) {
            throw new AppException(ErrorCode::JWT_INVALID);
        }

    }

    public function invalidateToken(string $token): ?string
    {
        // TODO: Implement invalidateToken() method.
        return null;
    }
}
