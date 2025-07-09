<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    // controls access to edit/update features
    public function update(User $user, User $model): Response
    {
        // users can ONLY update their own models, admins can update everything
        // every other user is stopped and redirected to 404 page
        return ($user->id === $model->id) || ($user->type === 'admin')
            ? Response::allow() 
            : Response::denyAsNotFound();
    }

    // controls access to delete feature
    public function delete(User $user, User $model): Response
    {
        return ($user->id === $model->id) || ($user->type === 'admin')
            ? Response::allow() 
            : Response::denyAsNotFound();
    }

}
