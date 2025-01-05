<?php

namespace Modules\Web\Adapters\Inbound\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Web\app\Dto\ApiResponse;
use Modules\Web\app\Services\User\UserService;


class UserController extends Controller
{
    public function apiCreate(Request $request): JsonResponse
    {
        $data = resolve(UserService::class)->create($request);
        return ApiResponse::success(data: $data);
    }
}
