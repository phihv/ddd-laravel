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

    public function apiGetCurrentUserInfo(Request $request): JsonResponse
    {
        return ApiResponse::success(data: $data ?? null);
    }

    public function apiIntrospect(Request $request): JsonResponse
    {
        $claimSet = resolve(AuthService::class)->introspect($request->token ?? '');
        return ApiResponse::success(data: ['jwt_claim_set' => $claimSet->toArray()]);
    }
}
