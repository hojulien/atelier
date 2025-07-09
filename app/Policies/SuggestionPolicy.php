<?php

namespace App\Policies;

use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SuggestionPolicy
{
    // only users can view their own suggestions (and admins)
    public function view(User $user, Suggestion $suggestion): Response
    {
        return ($user->id === $suggestion->user_id) || ($user->type === 'admin')
            ? Response::allow() 
            : Response::denyAsNotFound();
    }

}
