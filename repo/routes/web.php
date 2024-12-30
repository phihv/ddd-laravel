<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Kiểm tra xem 'welcome_message' có trong cache không
    $welcomeMessage = Cache::get('welcome_message');

    // Nếu không có trong cache, thiết lập giá trị và lưu vào cache
    if (!$welcomeMessage) {
        dd(1);
        $welcomeMessage = 'Welcome to Laravel';
        Cache::put('welcome_message', $welcomeMessage, 600); // Lưu trữ trong 10 phút (600 giây)
    }

    return $welcomeMessage;
});
