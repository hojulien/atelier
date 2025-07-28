<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = [
        'artist',
        'title',
        'artistUnicode',
        'titleUnicode',
        'creator',
        'sr',
        'length',
        'cs',
        'hp',
        'ar',
        'od',
        'setId',
        'mapId',
        'submitDate',
        'lastUpdated',
        'tags',
        'background'
    ];

    // casts is used to convert attributes to specific data types
    // 'tags' is stored as a JSON array in the database, which allows us to work with it as an array in our application
    protected $casts = [
        'tags' => 'array',
    ];

    // many-to-many relationship with User model
    // an user may like 0 to N maps - a map may be liked by 0 to N users
    public function likedByUsers() {
        return $this->belongsToMany(User::class, 'map_user_likes', 'map_id', 'user_id')->withPivot('created_at');
    }

    // many-to-many relationship with Playlist model
    // a map may compose 0 to N playlists - a playlist may be composed of 0 to N maps
    public function playlists() {
        return $this->belongsToMany(Playlist::class, 'map_playlist', 'map_id', 'playlist_id')->withPivot('created_at');
    }
}
