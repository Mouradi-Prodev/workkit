<?php

namespace App\Policies;

use App\Models\User;

class TeamPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user): bool
    {
        return $user->hasRole('team_lead');
    }
}
