<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class VehicleModelUpdateRequest extends FormRequest
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
            'name' => ['string', 'max:255', 'unique:vehicle_models'],
            'display_name' => ['string', 'max:255', 'unique:vehicle_models'],
            'estimated_price' => ['numeric', 'min_value:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field must not exceed 255 characters.',
            'name.unique' => 'The name field must be unique.',
            'display_name.string' => 'The display name field must be a string.',
            'display_name.max' => 'The display name field must not exceed 255 characters.',
            'display_name.unique' => 'The display name field must be unique.',
            'estimated_price.numeric' => 'The estimated price field must be a float.',
            'estimated_price.min_value' => 'The estimated price field must be  above 0.',
        ];
    }
}
