<?php

namespace Modules\Web\app\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Modules\Shared\Exception\ErrorCode;
use Modules\Web\app\Dto\ApiResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $e): void
    {
        parent::report($e);
    }


    public function render($request, Throwable $e): JsonResponse
    {
        dd($e);
        $errorCode = match (true) {
            $e instanceof \Modules\Shared\Exception\AppException => $e->getErrorCode(),
            $e instanceof \Illuminate\Validation\UnauthorizedException => ErrorCode::UNAUTHORIZED,
            default => ErrorCode::UNCATEGORIZED
        };
        return ApiResponse::error($errorCode->getMessage(), $errorCode->value, $errorCode->getHttpStatus());
    }
}

