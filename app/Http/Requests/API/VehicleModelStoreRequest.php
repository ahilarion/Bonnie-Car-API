<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:vehicle_models'],
            'display_name' => ['required', 'string', 'max:255', 'unique:vehicle_models'],
            'estimated_price' => ['required', 'numeric', 'min:0'],
            'gearbox' => ['required', 'string'],
            'fuel_type' => ['required', 'string'],
            'horse_power' => ['required', 'numeric', 'min:0'],
            'consumption' => ['required', 'numeric', 'min:0'],
            'release_year' => ['required', 'date_format:Y'],
            'vehicle_marque' => ['required', 'string', 'exists:vehicle_marques,name'],
            'vehicle_type' => ['required', 'string', 'exists:vehicle_types,name'],
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
