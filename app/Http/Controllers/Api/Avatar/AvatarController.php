<?php

namespace App\Http\Controllers\Api\Avatar;

use App\Http\Requests\Api\User\UpdateUserAvatarRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;

class AvatarController
{
    public function store(UpdateUserAvatarRequest $request)
    {
        $user = auth()->user();

        $image = $request->file('avatar');
        $image->storeAs('uploads', $user->uuid.'.'.$image->extension(), 'public');

        $crop = Image::load(storage_path('app/public/uploads/'.$user->uuid.'.'.$image->extension()));
        $crop->manualCrop($request->width, $request->height, $request->x, $request->y)->save();

        $user->addMedia(Storage::disk('public')->path('uploads/'.$user->uuid.'.'.$image->extension()))->toMediaCollection('avatar');

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
