<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ArticleStoreRequest extends FormRequest
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
            'thumbnail' => ['required', 'string', 'max:512'],
            // 'thumbnail' => ['required', 'file', 'max:1', 'mimes:jpeg,jpg,png'],
            'description' => ['required', 'string', 'max:512'],
            'short_description' => ['required', 'string', 'max:255'],
            'html_content' => ['required', 'string', 'max:65535'],
            // 'banner' => ['required', 'file', 'max:1' ,'mimes:jpeg,jpg,png']
            'banner' => ['required', 'string', 'max:512']

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

