<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\View\View;

class UserController
{
    public function __invoke(User $user): View
    {
        abort_unless($user->public_profile, 404);

        return view('profile.show', [
            'user' => $user,
        ]);
    }
}
