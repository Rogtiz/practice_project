<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    /**
     * Create a new policy instance.
     */
    // public function __construct()
    // {
    //     //
    // }

    use HandlesAuthorization;

    public function manageOrders(User $user)
    {
        return in_array($user->role, ['admin', 'manager']);
    }
}
