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

    // *********************************** MUTATORS *********************************** //
    /**
     * Set the artist's permalink.
     *
     * @param  string  $value
     * @return void
     */
    public function setPermalinkAttribute($value)
    {
        $this->attributes['permalink'] = strtolower(str_replace(' ', '-', $value));
    }
    // *********************************** STATIC ADMIN *********************************** //

    /**
     * Scope a query to get the artist singles.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeArtistSingles($query)
    {
        return $query->with(['singles' => function($query) {
            $query->select('id', 'artist_id', 'title')->get();
        }]);
    }

    /**
     * Scope a query to get the artist albums.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeArtistAlbums($query)
    {
        return $query->with(['albums' => function($query) {
            $query->select('id', 'artist_id', 'name')->get();
        }]);
    }

    /**
     * Scope a query to get the artist stems.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeArtistStems($query)
    {
        return $query->with(['stems' => function($query) {
            $query->select('id', 'artist_id', 'title')->get();
        }]);
    }

    // *********************************** RELATIONSHIPS *********************************** //
    /**
     * Get the singles for the current artist.
     */
    public function singles()
    {
        return $this->hasMany(Single::class);
    }

    /**
     * Get the albums for the current artist.
     */
    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    /**
     * Get the stems for the current artist.
     */
    public function stems()
    {
        return $this->hasMany(Stem::class);
    }
    // ************************************************************************************* //
}
