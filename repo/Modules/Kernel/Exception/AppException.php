<?php

namespace Modules\Kernel\Exception;

use Exception;

class AppException extends Exception
{
    private string $errorCode;

    public function __construct(string $message, string $errorCode, int $statusCode = 400)
    {
        parent::__construct($message, $statusCode);
        $this->errorCode = $errorCode;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
}

