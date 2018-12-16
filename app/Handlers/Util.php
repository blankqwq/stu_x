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
use App\Models\Topic;
use App\Models\User;
use App\WebSocket\Predis;
use Carbon\Carbon;

class Util
{
    public static function  makeData(int $code,string $message){
        $data=['code'=>$code,'message'=>$message];
        return json_encode($data);
    }

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

    public static function getJson($message){
        $user=User::find($message['user_id']);
        if ($message['type']=='message')
            $data=[
                'avatar'=>$user->avatar,
                'name'=>$user->name,
                'content'=>$message['content'],
                'type'=>$message['type'],
                'class_id'=>$message['class_id'],
                'created_at'=>Carbon::now()->toTimeString()
            ];
        if ($message['type']=='connect')
            $data=[
                'name'=>$user->name,
                'type'=>$message['type'],
                'class_id'=>$message['class_id'],
                'created_at'=>Carbon::now()->toTimeString()
            ];
        if ($message['type']=='quit')
            $data=[
                'name'=>$user->name,
                'type'=>$message['type'],
                'class_id'=>$message['class_id'],
                'created_at'=>Carbon::now()->toTimeString()
            ];
        return json_encode($data);
    }


    public static function getoutClass(Classes $classe){
        $content="你好，管理员已将你移除".$classe->name."团体";
        return $content;
    }

    public static function putTopic(Classes $classes,Topic $topic){
        if ($topic->type_id === 1)
            $content="你好，你的".$classes->name."团体,发送了一个公告《".$topic->title."》";
        else
            $content="你好，你的".$classes->name."团体,发送了一个需求《".$topic->title."》";
        return $content;
    }

}