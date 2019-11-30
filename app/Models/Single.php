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
        'title',
        'permalink',
        'feat',
        'version',
        'genre',
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
        'active'
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

    // DASHBOARD

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
}
