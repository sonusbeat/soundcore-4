<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersCreateRequest extends FormRequest
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
            'first_name' => 'required|between:3,150',
            'last_name' => 'required|between:3,150',
            'username' => 'required|between:3,150|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|between:8,16',
            'password_confirmation' => 'required|between:8,16|same:password',
            'image' => 'required|between:8,200',
            'type' => 'required',
        ];
    }
}
