<?php

use Illuminate\Support\Facades\Route;
use Modules\Web\Adapters\Inbound\Controllers\UserController;
use Modules\Web\Adapters\Inbound\Controllers\AuthenticationController;

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

Route::get('/ping', function () {return 'pong';});

Route::post('/users', [UserController::class, 'apiCreate']);
Route::post('/login', [AuthenticationController::class, 'apiLogin']);

Route::middleware(['validate-token'])->group(function () {
    Route::post('/introspect', [AuthenticationController::class, 'apiIntrospect'])->middleware('permission:introspect');
});
