<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25
 * Time: 13:53
 */

namespace App\Observers;


use App\Models\Classes;
use Spatie\Permission\Models\Role;

class ClassObserver
{
    //创建后的提交逻辑
    public function created(Classes $classes){
    }

    //审核成功的逻辑
    public function updating(Classes $classe){
        if ($classe->user_allow>0){
            $boss = $classe->creator;
            $role = Role::create(['name' => 'class'.$classe->id]);

            $boss->assignRole($role);
            //加入班级
            $boss->classes()->attach($classe->id);
        }else{
            //提醒一下用户
        }

    }

    public function updated(Classes $classe){
        dd($classe->user_allow > 0);
        if ($classe->user_allow > 0){
            $boss = $classe->creator;
            $role = Role::create(['name' => 'class'.$classe->id]);

            $boss->assignRole($role);
            //加入班级
            $boss->classes()->attach($classe->id);
        }else{
            //提醒一下用户
        }

    }

}