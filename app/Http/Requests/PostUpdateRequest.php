<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class PostUpdateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'images' => ['required', 'array', 'max:5'],
            'images.*' => ['required', 'file', 'mimes:jpeg,png,jpg', 'max:2048'],
            'constructor' => ['required', 'string', 'max:255'],
            'is_two_wheeled' => ['required', 'boolean'],
            'model' => ['required', 'string', 'max:255'],
            'original_price' => ['required', 'numeric'],
            'type' => ['required', 'string', 'max:255'],
            'energy_source' => ['required', 'string', 'max:255'],
            'transmission' => ['required', 'string', 'max:255'],
            'cylinder_capacity' => ['required', 'numeric'],
            'power' => ['required', 'numeric'],
            'torque' => ['required', 'numeric'],
            'year_of_manufacture' => ['required', 'numeric'],
            'production_year' => ['required', 'numeric'],
            'circulation_date' => ['required', 'date'],
            'technical_revision' => ['required', 'date'],
            'number_of_owners' => ['required', 'numeric'],
            'kilometers' => ['required', 'numeric'],
            'color' => ['required', 'string', 'max:255'],
            'number_of_doors' => ['required', 'numeric'],
            'seats' => ['required', 'numeric'],
            'vehicle_length' => ['required', 'numeric'],
            'condition' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @throws HttpResponseException
     */
    public function failedValidation(Validator $validator) : void
    {
        $errors = $validator->errors()->getMessages();

        throw new HttpResponseException(response()->json([
            'message' => 'The given data was invalid',
            'errors' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
