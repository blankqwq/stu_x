<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6
 * Time: 21:04
 */

namespace App\Observers;


use App\Jobs\SendNoticeJob;
use App\Models\Topic;

class TopicObserver
{

    public function created(Topic $topic){
        SendNoticeJob::dispatch($topic);
    }
}