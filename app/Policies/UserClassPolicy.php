<?php

namespace App\Policies;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserClassPolicy
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
     * 判断是否有权限进入主页
     * @param User $user
     * @param Classes $classes
     * @return bool
     */
    public function view(User $user,Classes $classes){
        return $user->isClassOf($classes->id) || $user->hasRole(config('code.role'));
    }

}
