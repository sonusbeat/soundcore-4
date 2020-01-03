<?php

namespace App\Models;

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
    // ************************ MUTATORS ************************ //
    /**
     * Trait album's permalink.
     *
     * @param  string  $value
     * @return void
     */
    public function setPermalinkAttribute($value)
    {
        $this->attributes['permalink'] = strtolower(str_replace(' ', '-', $value));
    }

    // ************************ RELATIONSHIPS ************************ //
    /**
     * Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function singles()
    {
        return $this->hasMany(Single::class);
    }

    /**
     * Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stems()
    {
        return $this->hasMany(Stem::class);
    }
    // *************************************************************** //

    /**
     * Get latest albums
     *
     * @param string $order Options: asc, desc
     * @param int $limit
     * @return Query
     */
    public static function latestAlbums($order = 'asc', $limit = 5)
    {
        return self::select('id', 'name')
            ->orderBy('created_at', $order)
            ->limit($limit)
            ->get();
    }
}
