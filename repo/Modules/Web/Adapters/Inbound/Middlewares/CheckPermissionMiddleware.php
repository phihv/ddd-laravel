<?php

namespace Modules\Web\Adapters\Inbound\Middlewares;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Kernel\Exception\AppException;
use Modules\Kernel\Exception\ErrorCode;
use Modules\Web\Adapters\Outbound\persistence\Repositories\EloquentUserRepository;
use Modules\Web\app\Services\Auth\AuthService;

class CheckPermissionMiddleware
{
    /**
     * @throws AppException
     */
    public function handle(Request $request, Closure $next, string $permission) {
        $user = Auth::user();

        $token = $request->bearerToken();
        $claimSet = resolve(AuthService::class)->introspect($token);
        $user = resolve(EloquentUserRepository::class)->findByEmail($claimSet->getSubject());
        Auth::setUser($user);

        if (empty($claimSet)) {
            throw new AppException(ErrorCode::JWT_INVALID);
        }
        return $next($request);
    }
}
