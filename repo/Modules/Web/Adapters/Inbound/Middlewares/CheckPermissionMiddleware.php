<?php

namespace Modules\Web\Adapters\Inbound\Middlewares;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Modules\Kernel\Exception\AppException;
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
            throw new UnauthorizedException();
        }
        $canPer = resolve(AuthService::class)->checkPermission($user->id, $permission);
        if ($canPer) {
            throw new UnauthorizedException();
        }
        return $next($request);
    }
}
