<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

class SinglesRequest extends FormRequest
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
     * @param Route $route
     * @return array
     */
    public function rules(Route $route)
    {
        $id = $route->single ? $route->single->id : null;

        return [
            'artist_id' => 'required',
            'title'     => 'required|between:3,200',
            'permalink' => 'required|between:3,200|unique:singles,permalink,'.$id,
            'feat'      => 'required|between:3,150',
            'version'   => 'required|between:3,50',
            'genre'     => 'required|between:3,100',
            'time'      => 'required|max:10',
            'bpm'       => 'required|max:8',
            'key'       => 'required|max:8',
            'catalog'   => 'required|between:3,150',
            'upc'       => 'required|between:3,255|unique:singles,upc,'.$id,
            'isrc'      => 'required|between:3,255|unique:singles,isrc,'.$id,
            'released_at'  => 'required|date',
            'description'  => 'required|min:8',
            'coverart'     => 'nullable|image|max:5000',
            'coverart_alt' => 'nullable|between:3,150',
            'beatport'   => 'nullable|between:12,255',
            'itunes'     => 'nullable|between:12,255',
            'spotify'    => 'nullable|between:12,255',
            'deezer'     => 'nullable|between:12,255',
            'soundcloud' => 'nullable|between:12,255',
            'youtube'    => 'nullable|between:12,255',
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
