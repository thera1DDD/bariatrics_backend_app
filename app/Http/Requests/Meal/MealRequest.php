<?php

namespace App\Http\Requests\Meal;

use Illuminate\Foundation\Http\FormRequest;

class MealRequest extends FormRequest
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
            'day_id' => 'nullable',
            'meal_start_at' => 'nullable',
            'meal_end_at' => 'nullable',
            'ate_at' => 'nullable',
            'type' => 'nullable',
            'users_id' => 'nullable',
        ];
    }
}
