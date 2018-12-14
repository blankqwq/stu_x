<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25
 * Time: 13:55
 */

namespace App\Observers;


use App\Handlers\Util;
use App\Models\Classes;
use App\Models\ClassUser;
use App\Models\User;
use App\Notifications\NewStuJinClass;
use App\Notifications\PersonMessage;

class ClassUserObserver
{
    //
    public function saved(ClassUser $classUser){

    }

    public function updating(ClassUser $classUser){
        //发送信息
        if ($classUser->token===null){
            Classes::find($classUser->class_id)->increment('numbers', 1);
            User::find($classUser->user_id)->notify(new PersonMessage(0,Util::makeOkJoin(Classes::find($classUser->class_id))));
        }elseif ($classUser->token===0){
            User::find($classUser->user_id)->notify(new PersonMessage(0,Util::makeNoJoin(Classes::find($classUser->class_id))));
        }
    }

    //信息通知创始人是否同意加入团体
    public function created(ClassUser $classUser){
        if ($classUser->token!==null)
            Classes::find($classUser->class_id)->creator->notify(new NewStuJinClass($classUser));
        elseif ($classUser->token===null)
            Classes::find($classUser->class_id)->increment('numbers', 1);

    }

    public function deleting(ClassUser $classUser){
        if ($classUser->token===null){
            Classes::find($classUser->class_id)->decrement('numbers', 1);
            User::find($classUser->user_id)->notify(new PersonMessage(0,Util::getoutClass(Classes::find($classUser->class_id))));
        }
    }

}