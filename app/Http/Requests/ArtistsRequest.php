<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

class ArtistsRequest extends FormRequest
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
        $id = $route->artist ? $route->artist->id : null;

        return [
            'first_name'  => 'required|between:3,150',
            'last_name'   => 'required|between:3,150',
            'artist_name' => 'required|between:3,150|unique:artists,artist_name,'.$id,
            'permalink'   => 'required|between:3,150|unique:artists,permalink,'.$id,
            'image'       => 'nullable|mimes:jpeg,jpg,png,gif|max:1024',
            'image_alt'   => 'nullable|between:3,150|unique:artists,image_alt,'.$id,
            'email'       => 'required|email|between:3,200|unique:artists,email,'.$id,
            'nationality' => 'required|between:3,200',
            'biography'   => 'required|min:8',
            'facebook'    => 'nullable|between:24,200|unique:artists,facebook,'.$id,
            'twitter'     => 'nullable|between:24,200|unique:artists,twitter,'.$id,
            'instagram'   => 'nullable|between:24,200|unique:artists,instagram,'.$id,
            'soundcloud'  => 'nullable|between:24,200|unique:artists,soundcloud,'.$id,
            'youtube'     => 'nullable|between:24,200|unique:artists,youtube,'.$id,
            'meta_title'  => 'required|between:8,70',
            'meta_description'  => 'required|between:8,165',
            'meta_robots' => [
                "required",
                Rule::in([
                    'index, follow',
                    'index, nofollow',
                    'noindex, follow',
                    'noindex, nofollow'
                ])
            ],
        ];
    }
}
