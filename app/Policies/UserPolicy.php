<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function createAuction(User $user)
    {
        return $user->hasRole('owner') && !$user->is_banned;
    }

    public function createCollection(User $user)
    {
        return $user->hasRole('owner') && !$user->is_banned;
    }

    public function comment(User $user)
    {
        return !$user->is_banned;
    }

    public function bid(User $user)
    {
        return !$user->is_banned;
    }

    public function useWallet(User $user)
    {
        return !$user->is_banned;
    }
}
