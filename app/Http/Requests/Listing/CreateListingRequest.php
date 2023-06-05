<?php

namespace App\Http\Requests\Listing;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateListingRequest extends FormRequest
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
            'description'=>['string','max:255','nullable'],
            'cadastral_number'=>['required','string','max:22'],
            'rental_status'=>['nullable',],
            'square'=>['required','numeric'],
            'rental_price'=>['nullable'],
            'price'=>['nullable','numeric'],
            'token'=>['string','required'],
            'city_id'=>['exists:cities,id','required'],
            'assignment_id'=>['exists:assignments,id','required'],
            'images'=>['required'],
            'images.*'=>['image','max:5000','mimes:png,jpg,bmp,jpeg']
        ];
    }
    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 302));
    }
}
