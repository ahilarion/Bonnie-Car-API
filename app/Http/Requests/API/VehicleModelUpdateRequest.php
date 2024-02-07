<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        // TODO : Lors de l'update :
        //! "Illuminate\\Database\\Eloquent\\Model::update(): Argument #1 ($attributes) must be of type array, App\\Http\\Requests\\API\\VehicleModelUpdateRequest given, called in D:\\WAMPP\\www\\Bonnie&Car\\Bonnie-Car-api\\app\\Repositories\\API\\VehicleModelRepository.php on line 103",
        return [
            'name' => ['string', 'max:255', 'unique:vehicle_models'],
            'display_name' => ['string', 'max:255'],
            'estimated_price' => ['numeric', 'min:0'],
            'gearbox' => ['string', 'max:255'],
            'fuel_type' => ['string', 'max:255'],
            'horse_power' => ['numeric', 'min:0'],
            'consumption' => ['numeric', 'min:0'],
            'release_year' => ['date_format:Y'],
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
