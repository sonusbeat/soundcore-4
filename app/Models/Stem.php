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
        'title',
        'permalink',
        'version',
        'time',
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

    public function artist()
    {
        return $this->belongsTo(Artist::class);
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
}
