<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/28
 * Time: 14:42
 */

namespace App\Handlers;


use App\Models\Classes;
use App\Models\Homework;
use App\Models\StuHomework;

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

    public static function putFraction(StuHomework $homework){
        $name=Homework::find($homework->homework_id)->title;
        $content="你好，你的作业《".$name."》分数为".$homework->fraction."分_(努力学习，刻意精进)";
        return $content;
    }

    public static function makeJoinMessage(Classes $classes,$content){
        $content=clean($content);
        $content="你好，我已经加入了你的".$classes->name."团体(消息：$content)";
        return $content;
    }


}