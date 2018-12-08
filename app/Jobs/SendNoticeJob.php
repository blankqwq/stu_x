<?php

namespace App\Jobs;

use App\Handlers\Util;
use App\Models\Classes;
use App\Models\Topic;
use App\Notifications\PersonMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNoticeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $topic;
    public $class;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Topic $topic)
    {
        $this->topic=$topic;
        $this->class=Classes::find($topic->class_id);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $students=$this->class->student()->get();

        foreach ($students as $student){
            $student->notify(new PersonMessage(0,Util::putTopic($this->class,$this->topic)));
        }
    }
}
