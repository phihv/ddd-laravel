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

class AccessTokenMiddleware
{
    /**
     * @throws AppException
     */
    public function handle(Request $request, Closure $next) {
        $token = $request->bearerToken();
        if (empty($token)) {
            throw new UnauthorizedException();
        }
        $claimSet = resolve(AuthService::class)->introspect($token);
        $user = resolve(EloquentUserRepository::class)->findByEmail($claimSet->getSubject());
        Auth::setUser($user);

        if (empty($claimSet)) {
            throw new AppException(ErrorCode::ACCESS_TOKEN_INVALID);
        }
        return $next($request);
    }
}
