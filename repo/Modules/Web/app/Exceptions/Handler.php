<?php

namespace Modules\Web\app\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Shared\Exception\ErrorCode;
use Modules\Web\app\Dto\ApiResponse;
use ReflectionException;
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


    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return JsonResponse
     */
    public function render($request, Throwable $e): JsonResponse
    {
        $errorCode = match (true) {
            $e instanceof \Modules\Shared\Exception\AppException => $e->getErrorCode(),
            $e instanceof ReflectionException =>  ErrorCode::REFLECTION,
            $e instanceof \Illuminate\Validation\ValidationException =>  ErrorCode::VALIDATION,
            $e instanceof \Illuminate\Validation\UnauthorizedException => ErrorCode::UNAUTHORIZED,
            default => ErrorCode::UNCATEGORIZED
        };

        $message = $errorCode->getMessage();
        if ($e instanceof \Illuminate\Validation\ValidationException) {
            $message = $message.': ';
            foreach ($e->errors() as $arrMess) {
                foreach ($arrMess as $m) {
                    $message = "$message\n$m";
                }
            }
        }


        return ApiResponse::error($message, $errorCode->value, $errorCode->getHttpStatus(), [$e->getMessage()]);
    }
}

