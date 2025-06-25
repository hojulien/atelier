<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $fillable = [
        'type',
        'description',
        'media',
        'user_id'
    ];

    // one-to-many relationship with User model
    // an user may create 0 to N suggestions - a suggestion can only be created by 1 user
    // belongsTo(Model, ForeignKeyCurrent, PrimaryKeyOther)
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
