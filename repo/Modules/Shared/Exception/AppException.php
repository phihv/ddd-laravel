<?php

namespace Modules\Shared\Exception;

use Exception;

class AppException extends Exception
{

    public function __construct(
        private ErrorCode $errorCode,
        string            $message = null,
        int               $statusCode = 400
    )
    {
        $message = "{$this->errorCode->getMessage()}: {$message}" ?? "{$this->errorCode->getMessage()}.";
        parent::__construct($message, $statusCode);
    }

    public function getErrorCode(): ErrorCode
    {
        return $this->errorCode;
    }
}

