<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Api\Auth\StoreRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController
{
    public function register(StoreRegisterRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified_at'] = now();

        return UserResource::make(User::create($validated));
    }
}
