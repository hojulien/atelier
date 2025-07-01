<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'avatar',
        'banner',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // one-to-many relationship with Playlist & Suggestion models
    // an user may create 0 to N playlists/suggestions - a playlist/suggestion can only be created by 1 user
    // hasMany(Model, ForeignKeyOther, PrimaryKeyCurrent)
    public function playlists() {
        return $this->hasMany(Playlist::class, 'user_id', 'id');
    }

    public function suggestions() {
        return $this->hasMany(Suggestion::class, 'user_id', 'id');
    }

    // many-to-many relationship with Map model
    // an user may like 0 to N maps - a map may be liked by 0 to N users
    // belongsToMany(Model, IntermediateTableName, ForeignKeyNameCurrent, ForeignKeyNameOther)
    public function likedMaps() {
        return $this->belongsToMany(Map::class, 'map_user_likes', 'user_id', 'map_id');
    }
}
