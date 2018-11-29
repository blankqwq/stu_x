<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25
 * Time: 13:53
 */

namespace App\Observers;


use App\Handlers\Util;
use App\Models\Classes;
use App\Models\User;
use App\Notifications\ClassCreate;
use App\Notifications\PersonMessage;
use Spatie\Permission\Models\Role;

class ClassObserver
{
    //创建后的提交逻辑
    public function created(Classes $classes){

        // 通知权限用户有人创建了小团体
        User::find(1)->notify(new ClassCreate($classes));

    }

    //审核成功的逻辑
    public function updating(Classes $classe){


    }

    public function updated(Classes $classe){
        if ($classe->user_allow > 0){
            $boss = $classe->creator;
            $role = Role::create(['name' => 'class'.$classe->id]);
            $boss->assignRole($role);
            //加入班级
            $boss->classes()->attach($classe->id);
            $boss->notify(new PersonMessage(0,Util::makeOkCreate($classe)));
        }else{
            //提醒一下用户未成功
            $boss = $classe->creator;
            $boss->notify(new PersonMessage(0,Util::makeNoCreate($classe)));

        }

    }

}