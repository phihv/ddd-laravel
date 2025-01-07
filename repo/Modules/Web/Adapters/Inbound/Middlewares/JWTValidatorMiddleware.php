<?php

namespace Modules\Web\Adapters\Inbound\Middlewares;
use Illuminate\Http\Request;

use Closure;
use Modules\Kernel\Exception\AppException;
use Modules\Kernel\Exception\ErrorCode;
use Modules\Web\app\Services\Auth\AuthService;

class JWTValidatorMiddleware
{
    /**
     * @throws AppException
     */
    public function handle(Request $request, Closure $next) {
        $token = $request->bearerToken();
        $claimSet = resolve(AuthService::class)->introspect($token);
        if (empty($claimSet)) {
            throw new AppException(ErrorCode::JWT_INVALID);
        }
        return $next($request);
    }
}
