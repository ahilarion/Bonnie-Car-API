<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required|email",
            "password" => "required|string",
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => "The email field is required.",
            "email.email" => "The email field must be a valid email address.",
            "password.required" => "The password field is required.",
            "password.string" => "The password field must be a string.",
        ];
    }
}
