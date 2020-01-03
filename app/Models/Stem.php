<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stem extends Model
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
        'version',
        'time',
        'bpm',
        'key',
        'catalog',
        'upc',
        'isrc',
        'released_at',
        'genre',
        'secondary_genre',
        'coverart',
        'coverart_alt',
        'description',
        'beatport',
        'traxsource',
        'juno',
        'meta_title',
        'meta_robots',
        'meta_description',
    ];

    /**
     * Get the artist of the stem.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Get the album of the stem.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * Get latest stems
     *
     * @param string $order Options: asc, desc
     * @param int $limit
     * @return Query
     */
    public static function latestStems($order = 'asc', $limit = 5)
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
    public function scopeStemArtist($query)
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
    public function scopeStemAlbum($query)
    {
        return $query->with(['album' => function($query) {
            $query->select('id', 'name')->get();
        }]);
    }
}
