<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class VehicleModelStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:vehicle_models'],
            'display_name' => ['required', 'string', 'max:255', 'unique:vehicle_models'],
            'estimated_price' => ['required', 'numeric', 'min:0'],
            'vehicle_marque' => ['required', 'string', 'exists:vehicle_marques,name'],
            'vehicle_type' => ['required', 'string', 'exists:vehicle_types,name'],
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
            'estimated_price.min' => 'The estimated price field must be at least 0.',
        ];
    }
}
