<?php

namespace App\Policies;

use App\Models\Classes;
use App\Models\User;
use App\Models\ClassUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassUserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the classUser.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClassUser  $classUser
     * @return mixed
     */
    public function view(User $user, ClassUser $classUser)
    {
        //
    }

    /**
     * Determine whether the user can create classUsers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the classUser.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClassUser  $classUser
     * @return mixed
     */
    public function update(User $user, ClassUser $classUser)
    {
        return $user->id===Classes::find($classUser->class_id)->user_id;
    }

    /**
     * Determine whether the user can delete the classUser.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClassUser  $classUser
     * @return mixed
     */
    public function delete(User $user, ClassUser $classUser)
    {
        //
    }
}
