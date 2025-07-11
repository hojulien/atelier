<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = [
        'name',
        'number_levels',
        'description',
        'type',
        'visibility',
        'user_id'
    ];

    // one-to-many relationship with User model
    // an user may create 0 to N playlists - a playlist can only be created by 1 user
    // belongsTo(Model, ForeignKeyCurrent, PrimaryKeyOther)
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // many-to-many relationship with Map model
    // a map may compose 0 to N playlists - a playlist may be composed of 0 to N maps
    public function maps() {
        return $this->belongsToMany(Map::class, 'map_playlist', 'playlist_id', 'map_id')->withPivot('created_at');
    }
}
