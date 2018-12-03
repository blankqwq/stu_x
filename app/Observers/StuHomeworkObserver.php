<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25
 * Time: 14:52
 */

namespace App\Observers;


use App\Handlers\Util;
use App\Models\StuHomework;
use App\Models\User;
use App\Notifications\PersonMessage;
use \Illuminate\Support\Facades\Auth;

class StuHomeworkObserver
{
    public function created(){

    }

    //作业修改完毕发送逻辑
    public function updated(StuHomework $homework){
        User::find($homework->user_id)->notify(new PersonMessage(Auth::user(),Util::putFraction($homework)));
    }

}