<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required','string', 'email', 'max:255', 'unique:users,email'],
            'name' => ['required','string', 'max:255'],
            'birthdate' => ['required','date'],
            'password' => ['required','string', 'min:8','nullable','confirmed'],
        ];
    }
    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 302));
    }
}
