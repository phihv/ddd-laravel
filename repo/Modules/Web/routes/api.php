<?php

use Illuminate\Support\Facades\Route;
use Modules\Web\app\Http\Controllers\UserController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::get('/ping', function () {
    return 'pong';
});


Route::post('/login', function () {
    return 'pong';
});

Route::post('/users', [UserController::class, 'create']);

