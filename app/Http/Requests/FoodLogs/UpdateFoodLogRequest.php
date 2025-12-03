<?php

namespace App\Http\Requests\FoodLogs;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodLogRequest extends FormRequest
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
              'food_name' => ['required', 'string', 'max:255'],
            'calories' => ['required', 'numeric'],
            'protein' => ['required', 'numeric'],
            'carbs' => ['required', 'numeric'],
            'fat' => ['required', 'numeric'],
            'sugar' => ['required', 'numeric'],
            'sodium' => ['required', 'numeric'],
            'vit_c' => ['required', 'numeric'],
            'vit_a' => ['required', 'numeric'],
            'potassium' => ['required', 'numeric'],
        ];
    }
}
