<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
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
