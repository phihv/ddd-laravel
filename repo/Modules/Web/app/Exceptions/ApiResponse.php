<?php

namespace Modules\Web\app\Exceptions;

class ApiResponse
{
    public static function error(string $message, string $errorCode): array
    {
        return [
            'success' => false,
            'message' => $message,
            'error_code' => $errorCode,
        ];
    }
}
