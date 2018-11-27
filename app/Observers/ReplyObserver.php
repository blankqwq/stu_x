<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27
 * Time: 13:11
 */

namespace App\Observers;


use App\Models\Replies;
use App\Notifications\TopicReplied;

class ReplyObserver
{
    public function created(Replies $reply){
        $topic = $reply->topics;

        // 通知作者话题被回复了
        $topic->sender->notify(new TopicReplied($reply));
    }

}