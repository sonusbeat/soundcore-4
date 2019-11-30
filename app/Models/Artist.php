<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'artist_name',
        'permalink',
        'image',
        'image_alt',
        'email',
        'nationality',
        'biography',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'soundcloud',
        'meta_title',
        'meta_description',
        'meta_robots',
    ];

    /**
     * Returns full name of the artist
     *
     * @return string
     */
    public function full_name()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    /**
     * Get the singles for the current artist.
     */
    public function singles()
    {
        return $this->hasMany(Single::class);
    }
}
