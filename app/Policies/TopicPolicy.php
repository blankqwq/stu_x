<?php

namespace App\Policies;

use App\Models\User;
use App\=Topic;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the =Topic.
     *
     * @param  \App\Models\User  $user
     * @param  \App\=Topic  $=Topic
     * @return mixed
     */
    public function view(User $user, =Topic $=Topic)
    {
        //
    }

    /**
     * Determine whether the user can create =Topics.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the =Topic.
     *
     * @param  \App\Models\User  $user
     * @param  \App\=Topic  $=Topic
     * @return mixed
     */
    public function update(User $user, =Topic $=Topic)
    {
        //
    }

    /**
     * Determine whether the user can delete the =Topic.
     *
     * @param  \App\Models\User  $user
     * @param  \App\=Topic  $=Topic
     * @return mixed
     */
    public function delete(User $user, =Topic $=Topic)
    {
        //
    }
}
