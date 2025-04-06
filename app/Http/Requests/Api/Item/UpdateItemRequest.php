<?php

namespace App\Http\Requests\Api\Item;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
        return [
            'data.media_type' => ['required', 'in:movie,tv,person', 'max:255'],
            'data.name' => ['required', 'string', 'max:255'],
            'data.synpsis' => ['nullable', 'string', 'max:5000'],
            'data.backdrop_path' => ['nullable', 'string', 'max:255'],
            'data.poster_path' => ['nullable', 'string', 'max:255'],
            'data.release_date' => ['nullable', 'string', 'max:255'],
            'data.note' => ['nullable', 'string', 'max:5000'],
            'data.watched' => ['boolean'],
        ];
    }
}
