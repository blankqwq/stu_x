<?php

namespace App\Policies;

use App\Models\User;
use App\ClassUserPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassUserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the classUserPolicy.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ClassUserPolicy  $classUserPolicy
     * @return mixed
     */
    public function view(User $user, ClassUserPolicy $classUserPolicy)
    {
        //
    }

    /**
     * Determine whether the user can create classUserPolicies.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the classUserPolicy.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ClassUserPolicy  $classUserPolicy
     * @return mixed
     */
    public function update(User $user, ClassUserPolicy $classUserPolicy)
    {
        //
    }

    /**
     * Determine whether the user can delete the classUserPolicy.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ClassUserPolicy  $classUserPolicy
     * @return mixed
     */
    public function delete(User $user, ClassUserPolicy $classUserPolicy)
    {
        //
    }
}
