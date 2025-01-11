<?php

namespace Modules\Web\app\Services\Auth;

use Illuminate\Http\Request;
use Modules\AuthApplication\Application\Ports\Inbound\AuthenticatorPort;
use Modules\AuthApplication\Application\Ports\Inbound\AuthorizationPort;
use Modules\AuthApplication\Domain\AccessToken;

readonly class AuthService
{
    public function __construct(
        private AuthorizationPort $authorizationPort,
        private AuthenticatorPort $authenticatorPort,
    )
    {
    }

    public function login(Request $request): ?array
    {
        $deviceInfo = [
            'ip' => $request->ip(),
            'name' => $request->header('User-Agent')
        ];
        $tokens = $this->authorizationPort->login($request['username'] ?? '', $request['password'] ?? '', $deviceInfo);
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
        return $this->authorizationPort->refreshAccessToken($refreshToken, $deviceInfo);
    }

    public function introspect($token): ?AccessToken
    {
        return $this->authorizationPort->introspect($token);
    }

    public function checkPermission(int $userId, string $permission): bool
    {
        return $this->authenticatorPort->checkPermission($userId, $permission);
    }


    public function createRole(Request $request): void
    {
        $this->authenticatorPort->createRole($request->toArray());
    }
    public function createPermission(Request $request): void
    {
        $this->authenticatorPort->createPermission($request->toArray());
    }
    public function addUserRole(Request $request): void
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'role_id' => 'required|integer',
        ]);
        $this->authenticatorPort->addUserRole($validatedData['user_id'], $validatedData['role_id']);
    }
    public function addRolePermission(Request $request): void
    {
        $this->authenticatorPort->addRolePermission($request->roleId ?? null, $request->permissionId ?? null);
    }
    public function removeUserRole(Request $request): void
    {
        $this->authenticatorPort->removeUserRole($request->userId ?? null, $request->roleId ?? null);
    }
    public function removeRolePermission(Request $request): void
    {
        $this->authenticatorPort->removeRolePermission($request->roleId ?? null, $request->permissionId ?? null);
    }

    public function updateRole(int $id, Request $request):void {
        $this->authenticatorPort->updateRole($id, $request->toArray());
    }
    public function updatePermission(int $id, Request $request):void {
        $this->authenticatorPort->updatePermission($id, $request->toArray());
    }
    public function deleteRole(Request $request):void {}
    public function deletePermission(Request $request):void {}
}
