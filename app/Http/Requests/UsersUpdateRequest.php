<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class UsersUpdateRequest extends FormRequest
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
    public function rules(Route $route)
    {
        return [
            'first_name' => 'required|between:3,150',
            'last_name' => 'required|between:3,150',
            'username' => 'required|between:3,150|unique:users,username,'.$route->user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$route->user->id,
            'password' => 'nullable|confirmed|between:8,16',
            'password_confirmation' => 'nullable|between:8,16|same:password',
            'image' => 'nullable|between:8,1024',
            'type' => 'required',
        ];
    }
}
