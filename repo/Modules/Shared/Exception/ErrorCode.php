<?php

namespace Modules\Shared\Exception;

enum ErrorCode: int
{
    case UNCATEGORIZED_EXCEPTION = 9999;

    case UNAUTHORIZED_EXCEPTION  = 1000;
    case FORBIDDEN  = 1001;
    case JWT_EXPIRED_EXCEPTION  = 1002;
    case JWT_SIGNATURE_INVALID_EXCEPTION   = 1003;
    case JWT_INVALID   = 1004;
    case DATA_NOT_FOUND = 1005;

    public function getMessage(): string
    {
        return match ($this) {
            self::UNCATEGORIZED_EXCEPTION => 'Lỗi không xác định.',
            self::UNAUTHORIZED_EXCEPTION => 'Thông tin xác thực sai hoặc thiếu.',
            self::FORBIDDEN => 'Truy cập không hợp lệ.',
            self::JWT_EXPIRED_EXCEPTION => 'Token hết hạn.',
            self::JWT_SIGNATURE_INVALID_EXCEPTION => 'Token signature không hợp lệ.',
            self::JWT_INVALID => 'Token không hợp lệ.',
            self::DATA_NOT_FOUND => 'Không tìm thấy dữ liệu.',
            default => 'Kiểm tra lại thông báo lỗi.',
        };
    }

    public function getHttpStatus(): string
    {
        return match ($this) {
            self::UNAUTHORIZED_EXCEPTION => 401,
            self::FORBIDDEN => 404,
            default => 400,
        };
    }
}
