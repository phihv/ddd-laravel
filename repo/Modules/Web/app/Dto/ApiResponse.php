<?php

namespace Modules\Web\app\Dto;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success(string $message = "Thành công", array $data = null): JsonResponse
    {
        $responseData = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($responseData);
    }
    public static function error(string $message, int $errorCode, int $httpStatus = 400): JsonResponse
    {

        $responseData =  [
            'success' => false,
            'message' => $message,
            'error_code' => $errorCode,
        ];
        return response()->json($responseData, $httpStatus);
    }
}
