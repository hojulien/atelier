<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $fillable = [
        'suggestion_type',
        'suggestion_description',
        'suggestion_media',
        'suggestion_userId'
    ];
    
    // TO DO: Relations
}
