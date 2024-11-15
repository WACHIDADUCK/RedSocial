<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function administrate(User $user)
    {
        return $user->admin == true;
    }


    public function __construct()
    {
        //
    }
}
