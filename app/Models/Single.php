<?php

namespace App\Models;

use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\Eloquent\Model;

class Single extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'artist_id',
        'album_id',
        'title',
        'permalink',
        'feat',
        'version',
        'genre',
        'time',
        'bpm',
        'key',
        'catalog',
        'upc',
        'isrc',
        'released_at',
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

    /**
     * Relationship
     *
     * @return string
     */
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Relationship
     *
     * @return string
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    // ************************ MUTATORS ************************ //
    /**
     * Trait single's permalink.
     *
     * @param  string  $value
     * @return void
     */
    public function setPermalinkAttribute($value)
    {
        $this->attributes['permalink'] = strtolower(str_replace(' ', '-', $value));
    }
    // ******************************************************* //

    // ***************** DASHBOARD ***************** //
    /**
     * Get latest singles
     *
     * @param string $order Options: asc, desc
     * @param int $limit
     * @return Query
     */
    public static function latestSingles($order = 'asc', $limit = 5)
    {
        return self::select('id', 'title')
            ->orderBy('created_at', $order)
            ->limit($limit)
            ->get();
    }

    /* -------------------------- SCOPES -------------------------- */
    /**
     * Scope a query to get the stems artist.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSingleArtist($query)
    {
        return $query->with(['artist' => function($query) {
            $query->select('id', 'artist_name')->get();
        }]);
    }

        /**
     * Scope a query to get the stems album.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSingleAlbum($query)
    {
        return $query->with(['album' => function($query) {
            $query->select('id', 'name')->get();
        }]);
    }
    // ********************************************** //
}
