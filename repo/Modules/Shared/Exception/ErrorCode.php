<?php

namespace Modules\Shared\Exception;

enum ErrorCode: int
{
    case UNCATEGORIZED = 9999;
    case UNAUTHORIZED  = 1000;
    case FORBIDDEN  = 1001;
    case ACCESS_TOKEN_EXPIRED  = 1002;
    case ACCESS_TOKEN_SIGNATURE_INVALID   = 1003;
    case ACCESS_TOKEN_INVALID   = 1004;
    case REFRESH_TOKEN_INVALID = 1005;
    case REFRESH_TOKEN_EXPIRED = 1006;
    case DATA_NOT_FOUND = 1007;

    public function getMessage(): string
    {
        return match ($this) {
            self::UNCATEGORIZED => 'Lỗi không xác định.',
            self::UNAUTHORIZED => 'Thông tin xác thực sai hoặc thiếu.',
            self::FORBIDDEN => 'Truy cập không hợp lệ.',
            self::ACCESS_TOKEN_EXPIRED => 'Access token hết hạn.',
            self::ACCESS_TOKEN_SIGNATURE_INVALID => 'Access token signature không hợp lệ.',
            self::ACCESS_TOKEN_INVALID => 'Access token không hợp lệ.',
            self::DATA_NOT_FOUND => 'Không tìm thấy dữ liệu.',
            default => 'Kiểm tra lại thông báo lỗi.',
        };
    }

    public function getHttpStatus(): string
    {
        return match ($this) {
            self::UNAUTHORIZED => 401,
            self::FORBIDDEN => 404,
            default => 400,
        };
    }
}
