<?php

namespace App\Livewire\Settings;

use App\Models\User;
use App\Rules\Username;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Profile extends Component
{
    public string $name = '';

    public string $username = '';

    public string $email = '';

    public ?string $description = '';

    public ?string $language = '';

    public bool $public_profile = false;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->username = Auth::user()->username;
        $this->email = Auth::user()->email;
        $this->public_profile = Auth::user()->public_profile;
        $this->description = Auth::user()->description;
        $this->language = Auth::user()->language;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'username' => [
                'required', 'string', 'min:4', 'max:50', Rule::unique(User::class)->ignore($user->id),
                new Username($user),
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],

            'public_profile' => ['boolean'],

            'language' => ['in:fr,en'],

            'description' => ['max:500'],
        ]);

        $user->fill($validated);

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }
}
