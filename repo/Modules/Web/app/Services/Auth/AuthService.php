<?php

namespace Modules\Web\app\Services\Auth;

use Illuminate\Http\Request;
use Modules\AuthApplication\Application\Ports\Inbound\AuthPort;
use Modules\AuthApplication\Domain\AccessToken;

class AuthService
{
    public function __construct(private readonly AuthPort $authCommandPort)
    {
    }

    public function login(Request $request): ?array
    {
        $deviceInfo = [
            'ip' => $request->ip(),
            'name' => $request->header('User-Agent')
        ];
        $tokens = $this->authCommandPort->login($request['username'] ?? '', $request['password'] ?? '', $deviceInfo);
        $cookie = [
            'refresh_token',
            $tokens['refreshToken']['token'],
            config('token.refresh_token_lifetime') / 60, // theo phút
            '/', // Path: all domain
            null, // Domain: null domain mặc định
            true, // Secure: HTTPS
            true, // HTTP-only
        ];
        return [
            'accessToken' => $tokens['accessToken'],
            'cookie' => $cookie
        ];
    }

    public function refreshAccessToken(Request $request)
    {
        $deviceInfo = [
            'ip' => $request->ip(),
            'name' => $request->header('User-Agent')
        ];
        return $this->authCommandPort->refreshAccessToken($request['refreshToken'], $deviceInfo);
    }

    public function introspect($token): ?AccessToken
    {
        return $this->authCommandPort->introspect($token);
    }

    public function checkPermission(int $userId, string $permission): bool
    {
        return $this->authCommandPort->checkPermission($userId, $permission);
    }
}
