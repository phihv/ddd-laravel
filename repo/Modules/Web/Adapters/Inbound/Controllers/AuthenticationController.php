<?php

namespace Modules\Web\Adapters\Inbound\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Web\app\Dto\ApiResponse;
use Modules\Web\app\Services\Auth\AuthService;


class AuthenticationController extends Controller
{
    public function apiLogin(Request $request): JsonResponse
    {
        $token = resolve(AuthService::class)->login($request);
        return ApiResponse::success(data: ['token' => $token]);
    }

    public function apiIntrospect(Request $request): JsonResponse
    {
        $decode = resolve(AuthService::class)->introspect($request->token ?? '');
        return ApiResponse::success(data: ['claims' => $decode]);
    }
}
