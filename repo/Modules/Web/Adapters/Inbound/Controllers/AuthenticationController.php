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
        $data = resolve(AuthService::class)->login($request);
        return ApiResponse::success(message: $data ? 'success' : 'fail');
    }
}
