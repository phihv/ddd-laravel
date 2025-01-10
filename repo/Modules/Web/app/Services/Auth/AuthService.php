<?php

namespace Modules\Web\app\Services\Auth;

use Illuminate\Http\Request;
use Modules\AuthApplication\Application\Ports\Inbound\AuthPort;
use Modules\AuthApplication\Domain\AccessToken;

readonly class AuthService
{
    public function __construct(private AuthPort $authPort)
    {
    }

    public function login(Request $request): ?array
    {
        $deviceInfo = [
            'ip' => $request->ip(),
            'name' => $request->header('User-Agent')
        ];
        $tokens = $this->authPort->login($request['username'] ?? '', $request['password'] ?? '', $deviceInfo);
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

    public function refreshAccessToken(Request $request): ?array
    {
        $deviceInfo = [
            'ip' => $request->ip(),
            'name' => $request->header('User-Agent')
        ];
        $refreshToken = $request->cookie('refresh_token');
        return $this->authPort->refreshAccessToken($refreshToken, $deviceInfo);
    }

    public function introspect($token): ?AccessToken
    {
        return $this->authPort->introspect($token);
    }

    public function checkPermission(int $userId, string $permission): bool
    {
        return $this->authPort->checkPermission($userId, $permission);
    }
}
