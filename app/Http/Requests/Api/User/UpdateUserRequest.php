<?php

namespace App\Http\Requests\Api\User;

use App\Models\User;
use App\Rules\Username;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = type($this->user())->as(User::class);

        return [
            'data.name' => ['required', 'string', 'max:255'],

            'data.username' => [
                'required', 'string', 'min:4', 'max:50',
                function ($attribute, $value, $fail) use ($user) {
                    $exists = User::where('username', $value)
                        ->where('id', '!=', $user->id)
                        ->exists();

                    if ($exists) {
                        $fail('The username is already taken by another user.');
                    }
                },
                new Username($user),
            ],

            'data.email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                function ($attribute, $value, $fail) use ($user) {
                    $exists = User::where('email', $value)
                        ->where('id', '!=', $user->id)
                        ->exists();

                    if ($exists) {
                        $fail('The username is already taken by another user.');
                    }
                },
            ],
            'data.public_profile' => ['boolean'],
            'data.language' => ['in:fr,en'],
            'data.description' => ['max:500'],
        ];
    }
}
