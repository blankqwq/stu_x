<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/28
 * Time: 14:42
 */

namespace App\Handlers;


use App\Models\Classes;

class Util
{

    public static function makeOkCreate(Classes $classes){
        $content="你好，你的".$classes->name."团体已通过审核";

        return $content;

    }

    public static function makeNoCreate(Classes $classes){
        $content="你好，你的".$classes->name."团体未通过审核具体原因您可以申诉1136589038@qq.com";
        return $content;
    }

    public static function makeOkJoin(Classes $classes){
        $content="你好，管理员已同意你加入".$classes->name."团体";
        return $content;
    }

    public static function makeNoJoin(Classes $classes){
        $content="你好，管理员不同意你加入".$classes->name."团体";
        return $content;
    }

}