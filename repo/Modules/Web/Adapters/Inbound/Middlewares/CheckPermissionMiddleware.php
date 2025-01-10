<?php

namespace Modules\Web\Adapters\Inbound\Middlewares;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Modules\Shared\Exception\AppException;
use Modules\Shared\Exception\ErrorCode;
use Modules\Web\Adapters\Outbound\persistence\Repositories\EloquentUserRepository;
use Modules\Web\app\Services\Auth\AuthService;

class CheckPermissionMiddleware
{
    /**
     * @throws AppException
     */
    public function handle(Request $request, Closure $next, string $permission) {
        $user = Auth::user();
        if (empty($user->id)) {
            throw new AppException(ErrorCode::FORBIDDEN);
        }
        $canPer = resolve(AuthService::class)->checkPermission($user->id, $permission);
        if ($canPer) {
            throw new AppException(ErrorCode::FORBIDDEN);
        }
        return $next($request);
    }
}
