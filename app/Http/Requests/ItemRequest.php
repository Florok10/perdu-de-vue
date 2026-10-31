<?php

namespace App\Http\Requests;

use App\Enums\Color;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules shared by the add and edit forms.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:60'],
            'color' => ['required', Rule::enum(Color::class)],
            'found_on' => ['required', 'date', 'before_or_equal:today'],
            'place_id' => ['required', 'integer', 'exists:places,id'],
            'description' => ['nullable', 'string', 'max:1000'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ];
    }

    /**
     * Get the French names of the fields used in the messages.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nom',
            'color' => 'couleur',
            'found_on' => 'date de découverte',
            'place_id' => 'lieu',
            'description' => 'description',
            'tags' => 'étiquettes',
            'tags.*' => 'étiquette',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'found_on.before_or_equal' => 'La date de découverte ne peut pas être dans le futur.',
        ];
    }
}
