<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25
 * Time: 13:53
 */

namespace App\Observers;


use App\Models\Classes;

class ClassObserver
{
    //创建后的提交逻辑
    public function created(Classes $classes){
    }

    //审核成功的逻辑
    public function updating(){


    }

}