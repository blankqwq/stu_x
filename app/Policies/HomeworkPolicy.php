<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Homework;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomeworkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the homework.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Homework  $homework
     * @return mixed
     */
    public function view(User $user, Homework $homework)
    {
        return $user->isClassOf($homework->class_id)||
            $user->hasRole(config('code.role').'|class'.$homework->class_id) ;
    }

    /**
     * Determine whether the user can create homeworks.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function createHomework(User $user,$id)
    {
        return true;
    }

    /**
     * Determine whether the user can update the homework.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Homework  $homework
     * @return mixed
     */
    public function update(User $user, Homework $homework)
    {
        return $user->id === $homework->teacher_id||
            $user->hasRole(config('code.role').'|class'.$homework->class_id) ;
    }

    /**
     * Determine whether the user can delete the homework.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Homework $homework
     * @return mixed
     */
    public function delete(User $user, Homework $homework)
    {
        return $user->isClassOf($homework->class_id)|| $user->hasRole(config('code.role')) ;
    }

    public function correct(User $user, Homework $homework){
        return $user->id === $homework->teacher_id;
    }
}
