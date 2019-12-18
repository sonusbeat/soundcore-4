<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

class StemsRequest extends FormRequest
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
        $id = $route->stem ? $route->stem->id : null;

        return [
            'artist_id' => 'required',
            'title'      => 'required|between:3,200',
            'permalink' => 'required|between:3,200|unique:singles,permalink,'.$id,
            'version' => 'required|between:3,100',
            'time' => 'required|max:6',
            'catalog' => 'required|between:3,150|unique:stems,catalog,'.$id,
            'upc'     => 'required|between:3,255',
            'isrc'    => 'required|between:3,255',
            'released_at' => 'required|date',
            'genre' => 'required|between:3,100',
            'secondary_genre' => 'required|between:3,100',
            'coverart'     => 'nullable|image|max:5000',
            'coverart_alt' => 'nullable|between:3,150',
            'description'  => 'required|min:8',
            'beatport'   => 'nullable|between:12,255',
            'traxsource' => 'nullable|between:12,255',
            'juno'       => 'nullable|between:12,255',
            'meta_title' => 'required|between:4,70',
            'meta_robots' => [
                "nullable",
                Rule::in([
                    'index, follow',
                    'index, nofollow',
                    'noindex, follow',
                    'noindex, nofollow'
                ]),
            ],
            'meta_description' => 'required|between:3,170'
        ];
    }
}
