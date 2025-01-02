<?php

namespace Modules\Web\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Web\app\Services\Auth\UserService;

class UserController extends Controller
{
    public function create(Request $request) {
        return resolve(UserService::class)->create($request);
    }
}
