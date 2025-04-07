<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserController
{
    public function index()
    {
        return UserResource::collection(User::where('public_profile', 1)->get());
    }

    public function show(string $username): UserResource
    {
        return new UserResource(User::where([
            'username' => $username,
            'public_profile' => 1,
        ])->firstOrFail());
    }
}
