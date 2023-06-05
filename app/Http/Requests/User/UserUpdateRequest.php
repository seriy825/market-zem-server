<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Laravel\Sanctum\PersonalAccessToken;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required','string','max:255'],
            'email' => ['required','string', 'email', 'max:255', 'unique:users,email,'.$this->route()->id],
            'phone'=>['required','string','min:16','max:16','regex:/^\+[0-9]{3}\s\d{2}\s\d{3}\s\d{4}/']
        ];
    }
    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 302));
    }

}
