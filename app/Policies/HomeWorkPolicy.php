<?php

namespace App\Policies;

use App\Models\User;
use App\=Homework;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomeWorkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the =Homework.
     *
     * @param  \App\Models\User  $user
     * @param  \App\=Homework  $=Homework
     * @return mixed
     */
    public function view(User $user, =Homework $=Homework)
    {
        //
    }

    /**
     * Determine whether the user can create =Homeworks.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the =Homework.
     *
     * @param  \App\Models\User  $user
     * @param  \App\=Homework  $=Homework
     * @return mixed
     */
    public function update(User $user, =Homework $=Homework)
    {
        //
    }

    /**
     * Determine whether the user can delete the =Homework.
     *
     * @param  \App\Models\User  $user
     * @param  \App\=Homework  $=Homework
     * @return mixed
     */
    public function delete(User $user, =Homework $=Homework)
    {
        //
    }
}
