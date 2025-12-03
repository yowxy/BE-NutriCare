<?php

namespace App\Http\Controllers\Api\Users;

use App\Helpers\ResponseFromatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function  show (User $user)
    {
        return ResponseFromatter::success($user);
    }

    public function update(UpdateUserRequest $request , User $user)
    {
        $user->update($request->validated());
        // return ResponseFromatter::success($user);
    }
}
