<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Password;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;

class ResetPasswordController
{
    public function reset(ResetPasswordRequest $request)
    {
        $validated = $request->validated();

        Password::sendResetLink(['email' => $validated['email']]);
    }
}
