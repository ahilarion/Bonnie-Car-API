<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ArticleUpdateRequest extends FormRequest
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
            'title' => ['string', 'max:255'],
            // 'thumbnail' => ['file', 'max:1', 'mimes:jpeg,jpg,png'],
            'thumbnail' => ['string', 'max:512'],
            'description' => ['string', 'max:512'],
            'short_description' => ['string', 'max:255'],
            'html_content' => ['string', 'max:65535'],
            'banner' => ['string', 'max:512'],
            'tags' => ['array', 'max:50']
            // 'banner' => ['file', 'max:1' ,'mimes:jpeg,jpg,png']
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
