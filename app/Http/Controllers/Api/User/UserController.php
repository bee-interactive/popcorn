<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Requests\Api\User\UpdateUserPasswordRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Requests\Api\User\UpdateUserTmdbTokenRequest;
use App\Http\Resources\MeResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function update(UpdateUserRequest $request, string $uuid)
    {
        $user = auth()->user();

        $user->update([
            'name' => $request->validated('data.name'),
            'username' => $request->validated('data.username'),
            'email' => $request->validated('data.email'),
            'public_profile' => $request->validated('data.public_profile'),
            'language' => $request->validated('data.language'),
            'description' => $request->validated('data.description'),
        ]);

        return new UserResource($user);
    }

    public function password(UpdateUserPasswordRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'password' => Hash::make($request->validated('password')),
        ]);

        return new UserResource($user);
    }

    public function tmdb(UpdateUserTmdbTokenRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'tmdb_token' => $request->validated('tmdb_token'),
        ]);

        return new UserResource($user);
    }

    public function me(): MeResource
    {
        return new MeResource(auth()->user());
    }
}
