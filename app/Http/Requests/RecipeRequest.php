<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string|max:255',
            'ingredients.*.quantity' => 'required|string|min:0',
            'ingredients.*.description' => 'nullable|string|max:255',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'ingredients' => collect($this->input('ingredients'))
                ->filter(function (array $ingredient) {
                    return $ingredient['quantity'] > 0;
                })->values()->all(),
        ]);
    }
}
