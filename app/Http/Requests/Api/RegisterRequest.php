<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email','unique:users,email'],
            'password' => 'required',
            'name' => ['required', 'max:35'],
            'username'=>['required','unique:users,username'],
            'type_id'=>['required', 'numeric','exists:user_types,id'],
            'avatar'=>['nullable','image']
        ];

    }
}
