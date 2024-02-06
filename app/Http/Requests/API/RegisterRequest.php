<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "first_name" => ["required", "string", "max:255"],
            "last_name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255", "unique:users"],
            "password" => ["required", "string", "min:8", "max:255"],
        ];
    }

    public function messages(): array
    {
        return [
            "first_name.required" => "The first name field is required.",
            "first_name.string" => "The first name field must be a string.",
            "first_name.max" => "The first name field must not exceed 255 characters.",
            "last_name.required" => "The last name field is required.",
            "last_name.string" => "The last name field must be a string.",
            "last_name.max" => "The last name field must not exceed 255 characters.",
            "email.required" => "The email field is required.",
            "email.string" => "The email field must be a string.",
            "email.email" => "The email field must be a valid email address.",
            "email.max" => "The email field must not exceed 255 characters.",
            "email.unique" => "The email field must be unique.",
            "password.required" => "The password field is required.",
            "password.string" => "The password field must be a string.",
            "password.min" => "The password field must be at least 8 characters.",
            "password.max" => "The password field must not exceed 255 characters.",
        ];
    }
}
