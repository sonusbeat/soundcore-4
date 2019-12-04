<?php

namespace App;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'artist_id',
        'name',
        'permalink',
        'catalog',
        'upc',
        'isrc',
        'released_at',
        'tracks_quantity',
        'various_artists',
        'genre',
        'description',
        'coverart',
        'coverart_alt',
        'beatport',
        'itunes',
        'spotify',
        'deezer',
        'soundcloud',
        'youtube',
        'meta_title',
        'meta_robots',
        'meta_description',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
