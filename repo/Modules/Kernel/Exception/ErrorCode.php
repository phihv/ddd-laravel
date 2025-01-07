<?php

namespace Modules\Kernel\Exception;

enum ErrorCode: int
{
    case UNCATEGORIZED_EXCEPTION = 9999;
    case JWT_EXPIRED_EXCEPTION  = 1001;
    case JWT_SIGNATURE_INVALID_EXCEPTION   = 1002;
    case JWT_INVALID   = 1003;
    case DATA_NOT_FOUND = 1004;

    public function getMessage(): string
    {
        return match ($this) {
            self::UNCATEGORIZED_EXCEPTION => 'Lỗi không xác định',
            self::JWT_EXPIRED_EXCEPTION => 'Token hết hạn',
            self::JWT_SIGNATURE_INVALID_EXCEPTION => 'Token chữ ký không hợp lệ',
            self::JWT_INVALID => 'Token không hợp lệ',
            self::DATA_NOT_FOUND => 'Không tìm thấy dữ liệu',
        };
    }
}
