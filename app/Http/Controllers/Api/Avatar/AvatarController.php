<?php

namespace App\Http\Controllers\Api\Avatar;

use App\Http\Resources\UserResource;
use App\Http\Requests\Api\User\UpdateUserAvatarRequest;

class AvatarController
{
    public function store(UpdateUserAvatarRequest $request)
    {
        $user = auth()->user();

        $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');

        cache()->flush();

        return new UserResource($user->fresh());
    }

    public function destroy()
    {
        $user = auth()->user();

        $user->clearMediaCollection('avatar');

        cache()->flush();

        return new UserResource($user->fresh());
    }
}
