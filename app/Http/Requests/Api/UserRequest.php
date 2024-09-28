<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UserRequest extends FormRequest
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
    public function rules($uuid = null)
    {
        $rules =  [
            'email' => ['required', 'email',Rule::unique('users','email')->ignore($uuid,'uuid')],
            'name' => ['required', 'max:35'],
            'username'=>['required',Rule::unique('users','email')->ignore($uuid,'uuid')],
            'type_id'=>['required', 'numeric','exists:user_types,id'],
            'avatar'=>['nullable','image'],

        ];

        if(!$uuid)
        {
            return array_merge($rules, ['password' => 'required|min:6']); //handle password on update
        }

        if(auth()->user() && auth()->user()->hasRole('super-admin'))
        {
            return array_merge($rules, ['role'=>['required','exists:roles,name']]);    //handle roles when user is added or updated by admin
        }


        return $rules;

    }
}
