<?php

namespace App\Http\Requests\MealsFood;

use Illuminate\Foundation\Http\FormRequest;

class MealFoodRequest extends FormRequest
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
            'meals_id' => 'nullable',
            'foods_id' => 'nullable',
            'quantity' => 'nullable',
        ];
    }
}
