<?php

namespace Modules\Web\Adapters\Inbound\Controllers;

use Illuminate\Http\Request;
use Modules\Web\app\Services\Auth\UserService;

class UserController extends Co
{
    public function create(Request $request) {
        resolve(UserService::class)->create($request);
    }
}
