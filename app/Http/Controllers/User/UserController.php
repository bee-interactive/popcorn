<?php

namespace App\Http\Controllers\User;

use App\Models\User;

class UserController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        abort_unless($user->public_profile, 404);

        return view('profile.show', [
            'user' => $user,
        ]);
    }
}
