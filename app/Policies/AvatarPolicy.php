<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AvatarPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }
    
    public function lists(User $user)
    {
        return $user->permissions()->contains('avatar-list');
    }

    public function add(User $user)
    {
        return $user->permissions()->contains('avatar-add');
    }

    public function edit(User $user)
    {
        return $user->permissions()->contains('avatar-edit');
    }
}
