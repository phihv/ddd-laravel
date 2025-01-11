<?php

namespace Modules\Web\Adapters\Inbound\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Web\app\Dto\ApiResponse;
use Modules\Web\app\Services\Auth\AuthService;


class AuthController extends Controller
{
    public function apiLogin(Request $request): JsonResponse
    {
        $data = resolve(AuthService::class)->login($request);

        return ApiResponse::success(data: $data['accessToken'])->cookie(...$data['cookie']);
    }

    public function apiRefreshAccessToken(Request $request): JsonResponse
    {
        $token = resolve(AuthService::class)->refreshAccessToken($request);
        return ApiResponse::success(data: $token);
    }

    public function apiIntrospect(Request $request): JsonResponse
    {
        $claimSet = resolve(AuthService::class)->introspect($request->token ?? '');
        return ApiResponse::success(data: ['jwt_claim_set' => $claimSet->toArray()]);
    }

    public function apiCreateRole(Request $request): JsonResponse
    {
        resolve(AuthService::class)->createRole($request);
        return ApiResponse::success();
    }

    public function apiCreatePermission(Request $request): JsonResponse
    {
        resolve(AuthService::class)->createPermission($request);
        return ApiResponse::success();
    }

    public function apiAddUserRole(Request $request): JsonResponse
    {
        resolve(AuthService::class)->addUserRole($request);
        return ApiResponse::success();
    }

    public function apiAddRolePermission(Request $request): JsonResponse
    {
        resolve(AuthService::class)->addRolePermission($request);
        return ApiResponse::success();
    }

    public function apiRemoveUserRole(Request $request): JsonResponse
    {
        resolve(AuthService::class)->removeUserRole($request);
        return ApiResponse::success();
    }

    public function apiRemoveRolePermission(Request $request): JsonResponse
    {
        resolve(AuthService::class)->removeRolePermission($request);
        return ApiResponse::success();
    }

    public function apiUpdateRole(int $id, Request $request): JsonResponse
    {
        resolve(AuthService::class)->updateRole($id, $request);
        return ApiResponse::success();
    }

    public function apiUpdatePermission(int $id, Request $request): JsonResponse
    {
        resolve(AuthService::class)->updatePermission($id, $request);
        return ApiResponse::success();
    }

    public function apiDeleteRole(Request $request): JsonResponse
    {
        resolve(AuthService::class)->deleteRole($request);
        return ApiResponse::success();
    }

    public function apiDeletePermission(Request $request): JsonResponse
    {
        resolve(AuthService::class)->deletePermission($request);
        return ApiResponse::success();
    }
}
