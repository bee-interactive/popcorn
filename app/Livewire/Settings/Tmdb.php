<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Tmdb extends Component
{
    public ?string $token = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->token = Auth::user()->tmdb_token;
    }

    /**
     * Update the password for the currently authenticated user.
     */
    public function updateToken(): void
    {
        try {
            $validated = $this->validate([
                'token' => ['required', 'string'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('token');

            throw $e;
        }

        Auth::user()->update([
            'tmdb_token' => $validated['token'],
        ]);

        $this->reset('token');

        $this->dispatch('token-updated');
    }
}
