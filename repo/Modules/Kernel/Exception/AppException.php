<?php

namespace Modules\Kernel\Exception;

use Exception;

class AppException extends Exception
{

    public function __construct(
        private ErrorCode $errorCode,
        string            $message = null,
        int               $statusCode = 400
    )
    {
        $message = $message ?? $this->errorCode->getMessage();
        parent::__construct($message, $statusCode);
    }

    public function getErrorCode(): ErrorCode
    {
        return $this->errorCode;
    }
}

