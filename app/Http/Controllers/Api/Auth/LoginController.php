<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();

            $success['token'] = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['success' => $success], 200);
        }

        return response()->json(['error' => 'Nope, Unauthorized'], 401);

    }
}
