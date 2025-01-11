<?php

use Illuminate\Support\Facades\Route;
use Modules\Web\Adapters\Inbound\Controllers\UserController;
use Modules\Web\Adapters\Inbound\Controllers\AuthController;

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

Route::post('/users', [UserController::class, 'apiCreate']);
Route::post('/login', [AuthController::class, 'apiLogin']);
Route::post('/refresh-token', [AuthController::class, 'apiRefreshAccessToken']);

Route::middleware(['validate-token'])->group(function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/introspect', [AuthController::class, 'apiIntrospect'])->middleware('permission:introspect');
        Route::post('/create-role', [AuthController::class, 'apiCreateRole'])->middleware('permission:admin-rbac');
        Route::post('/create-permission', [AuthController::class, 'apiCreatePermission'])->middleware('permission:admin-rbac');
        Route::post('/add-user-role', [AuthController::class, 'apiAddUserRole'])->middleware('permission:admin-rbac');
        Route::post('/add-role-permission', [AuthController::class, 'apiAddRolePermission'])->middleware('permission:admin-rbac');
        Route::post('/remove-user-role', [AuthController::class, 'apiRemoveUserRole'])->middleware('permission:admin-rbac');
        Route::post('/remove-role-permission', [AuthController::class, 'apiRemoveRolePermission'])->middleware('permission:admin-rbac');
        Route::put('/update-role/{id}', [AuthController::class, 'apiUpdateRole'])->middleware('permission:admin-rbac');
        Route::put('/update-permission/{id}', [AuthController::class, 'apiUpdatePermission'])->middleware('permission:admin-rbac');
        Route::delete('/delete-role/{id}', [AuthController::class, 'apiDeleteRole'])->middleware('permission:admin-rbac');
        Route::delete('/delete-permission/{id}', [AuthController::class, 'apiDeletePermission'])->middleware('permission:admin-rbac');
    });
});
