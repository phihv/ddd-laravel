<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $welcomeMessage = Cache::get('welcome_message');

    if (!$welcomeMessage) {
        $welcomeMessage = 'Welcome to Laravel';
        Cache::put('welcome_message', $welcomeMessage, 600);
    }

    return $welcomeMessage;
});
