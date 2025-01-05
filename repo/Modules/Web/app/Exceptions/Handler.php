<?php

namespace Modules\Web\app\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Modules\Kernel\Exception\AppException;
use Modules\Kernel\Exception\ErrorCode;
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


    public function render($request, Throwable $e)
    {
        if ($e instanceof AppException) {
            return ApiResponse::error($e->getMessage(), $e->getErrorCode());
        }

        return ApiResponse::error($e->getMessage(), ErrorCode::UNCATEGORIZED_EXCEPTION->value);
//        return parent::render($request, $e);
    }
}

