<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final readonly class Username implements ValidationRule
{
    /**
     * Create a new rule instance.
     *
     * @param  array<int, string>  $reserved
     */
    public function __construct(
        private ?User $user = null,
        private array $reserved = [
            'popcorn',
        ]
    ) {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = type($value)->asString();

        if (preg_match('/[A-Za-z].*[A-Za-z]/', $value) === 0) {
            $fail('The :attribute must contain at least 2 letters.');

            return;
        }

        if (preg_match('/^\w+$/', $value) === 0) {
            $fail('The :attribute may only contain letters, numbers, and underscores.');

            return;
        }

        if (in_array($value, $this->reserved, true)) {
            $fail('The :attribute is reserved.');

            return;
        }

        $query = User::whereRaw('lower(username) = ?', [mb_strtolower($value)]);

        if ($this->user instanceof User) {
            $query->where('id', '!=', $this->user->id);
        }

        if ($query->exists()) {
            $fail('The :attribute has already been taken.');
        }
    }
}
