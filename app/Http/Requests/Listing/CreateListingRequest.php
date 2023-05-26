<?php

namespace App\Http\Requests\Listing;

use Illuminate\Foundation\Http\FormRequest;

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
            'cadastral_number'=>['string','max:22'],
            'rental_status'=>['nullable','date'],
            'square'=>['numeric'],
            'rental_price'=>['nullable','numeric'],
            'price'=>['nullable','numeric'],
            'token'=>['string','required'],
            'city_id'=>['exists:cities,id','required'],
            'assignment_id'=>['exists:assignments,id','required'],
        ];
    }
}
