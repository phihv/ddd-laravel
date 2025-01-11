<?php

return [
    'required' => ':attribute là bắt buộc.',
    'integer' => ':attribute phải là số nguyên.',
    'exists' => ':attribute không tồn tại.',
    'email' => ':attribute phải là một địa chỉ email hợp lệ.',
    'max' => [
        'string' => ':attribute không được vượt quá :max ký tự.',
        'numeric' => ':attribute không được lớn hơn :max.',
    ],
    'min' => [
        'string' => ':attribute phải có ít nhất :min ký tự.',
        'numeric' => ':attribute phải lớn hơn hoặc bằng :min.',
    ],
//    // Thêm các thông báo khác nếu cần
//    'attributes' => [
//        'user_id' => 'ID người dùng',
//        'role_id' => 'ID vai trò',
//    ],
];
