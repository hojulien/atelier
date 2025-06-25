<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = [
        'playlist_name',
        'playlist_numberLevels',
        'playlist_description',
        'playlist_type',
        'playlist_userId'
    ];

    // TO DO: Relations
}
