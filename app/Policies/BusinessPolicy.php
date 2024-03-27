<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Business;


class BusinessPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function store(User $user, Business $business)
    {
        return $user->role == 'admin' ? true : false;
    }

    public function show(User $user, Business $business)
    {
        return $business->user_id == auth()->id() ? true : false;
    }
}
