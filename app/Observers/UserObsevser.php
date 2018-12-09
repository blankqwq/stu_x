<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25
 * Time: 12:58
 */

namespace App\Observers;


use App\Models\User;
use  \Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class UserObsevser
{
    public function creating(){

    }

    public function created(){

    }

    public function updated(){
        Cache::forget('user'.Auth::id());
    }

    public function saved(User $user)
    {
        Cache::forget('user'.Auth::id());
    }
    public function deleting(){

    }


    public function saving(User $user){
        if(empty($user->avatar)){
            $user->avatar="";
        }
    }

}