<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = [
        'maps_rc',
        'maps_artist',
        'maps_title',
        'maps_artistUnicode',
        'maps_titleUnicode',
        'maps_creator',
        'maps_sr',
        'maps_length',
        'maps_cs',
        'maps_hp',
        'maps_ar',
        'maps_od',
        'maps_setId',
        'maps_mapId',
        'maps_submitDate',
        'maps_lastUpdated',
        'maps_tags',
        'maps_background'
    ];

    // TO DO: Relations
}
