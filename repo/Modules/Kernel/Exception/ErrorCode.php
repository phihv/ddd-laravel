<?php

namespace Modules\Kernel\Exception;

enum ErrorCode: int
{
    case UNCATEGORIZED_EXCEPTION = 9999;

    // Thêm phương thức tiện ích (nếu cần)
    public function getMessage(): string
    {
        return match ($this) {
            self::UNCATEGORIZED_EXCEPTION => 'Lỗi không xác định'
        };
    }
}
