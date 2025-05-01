<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Password;

class ResetPasswordController
{
    public function reset()
    {
        Password::sendResetLink(['email' => request('email')]);

        return response()->json(['success' => 'Success'], 200);
    }
}
