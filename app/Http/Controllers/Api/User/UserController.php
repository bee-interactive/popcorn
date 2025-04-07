<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Resources\MeResource;
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

    public function me(): MeResource
    {
        return new MeResource(auth()->user());
    }
}
