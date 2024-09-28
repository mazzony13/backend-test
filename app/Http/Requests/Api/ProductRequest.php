<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:30'],
            'description' => 'required',
            'slug' => ['required', 'max:15'],
            'is_active'=>['nullable'],
            'image'=>['sometimes','image'],
            'price'=>['required','array' ,'required_array_keys:'.implode(",",\App\Models\UserType::get()->pluck('name')->toArray())], //validate array keys to be generic based on user types data
            'price.*'=>['required','numeric'], // validate each item to be numeric

        ];

    }
}
