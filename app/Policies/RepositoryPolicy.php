<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Repository;
use Illuminate\Auth\Access\HandlesAuthorization;

class RepositoryPolicy
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
    /**
     * Valid if user has access to this repository
     */
    public function pass(User $user, Repository $repository)
    {
        return $user->id == $repository->user_id;
    }
}
