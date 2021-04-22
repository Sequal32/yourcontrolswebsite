<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailAuthRegisterRequest extends FormRequest
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
            'username'          => 'required|string|max:50',
            'password'          => 'required|string|max:50|min:8',
            'c_password'        => 'required|string|max:50|min:8|same:password',
            'email'             => 'required|string|max:50|unique:users',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'        => 'Email is required',
            'username.required'     => 'Username is required',
            'password.required'     => 'Password is required',
            'c_password.required'   => 'Confirmation Password is required',
            'c_password.same'       => 'Confirmation Password does not match with the Password',
            'email.unique'          => 'This email is taken',
        ];
    }
}
