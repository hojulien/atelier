<?php

namespace App\Policies;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlaylistPolicy
{
    // to update with public/private playlist implementation
    public function view(User $user, Playlist $playlist): bool
    {
        return false;
    }

    // controls access to edit/update features
    public function update(User $user, Playlist $playlist): Response
    {
        return ($user->id === $playlist->user_id) || ($user->type === 'admin')
            ? Response::allow() 
            : Response::denyAsNotFound();
    }

    // controls access to delete feature
    public function delete(User $user, Playlist $playlist): Response
    {
        return ($user->id === $playlist->user_id) || ($user->type === 'admin')
            ? Response::allow() 
            : Response::denyAsNotFound();
    }

}
