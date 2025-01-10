<?php

namespace Modules\Web\Adapters\Inbound\Middlewares;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Shared\Exception\AppException;
use Modules\Shared\Exception\ErrorCode;
use Modules\Web\Adapters\Outbound\persistence\Repositories\EloquentUserRepository;
use Modules\Web\app\Services\Auth\AuthService;

class JWTValidatorMiddleware
{
    /**
     * @throws AppException
     */
    public function handle(Request $request, Closure $next) {
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
