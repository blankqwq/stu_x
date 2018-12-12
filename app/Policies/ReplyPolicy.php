<?php

namespace App\Policies;

use App\Models\Replies;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the reply.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Replies  $reply
     * @return mixed
     */
    public function view(User $user, Replies $reply)
    {
        //
    }

    /**
     * Determine whether the user can create replies.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the reply.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Replies  $reply
     * @return mixed
     */
    public function update(User $user, Replies $reply)
    {
        return $user->id === $reply->user_id;
    }

    /**
     * Determine whether the user can delete the reply.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Replies  $reply
     * @return mixed
     */
    public function delete(User $user, Replies $reply)
    {
        return $user->id === $reply->user_id;
    }
}
