<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/7
 * Time: 14:11
 */

namespace App\Models\Traits;




use App\Models\Classes;
use App\Models\ClassUser;
use App\Models\Homework;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

trait HomeworkHelper
{

    protected $cache_key='cache_key_user_';

    protected $cache_time=120;

    public function getHomework($id)
    {
        return Cache::remember($this->cache_key.$id, $this->cache_time, function() use ($id){
            return $this->caculateHomework($id);
        });
    }

    public function calculateAndCacheHomework($id)
    {
        $homework_get = $this->caculateHomework($id);
        $this->cacheHomework($id,$homework_get);
    }

    public function caculateHomework($id){
        $user=$this->find($id);
        $class_ids=ClassUser::select(['class_id'])->where('user_id',$user->id)->where('token',null)->get();
        $homework_get = collect();
        foreach ($class_ids as $class_id){

            $homeworks=Homework::where('class_id',$class_id->class_id)
                ->where('stop_time','>',Carbon::now())->get();
            foreach ($homeworks as $h){
                $homework = Homework::find($h->id);
                if ($homework) {
                    $homework_get->push($homework);
                }
            }
        }
        return $homework_get;
    }
    public function caculateAllHomework(){
        $users_ids=$this->all(['id']);

        foreach ($users_ids as $users_id){
            $this->calculateAndCacheHomework($users_id->id);
        }
    }


    private function cacheHomework($id,$homework_get)
    {
        // 将数据放入缓存中
        Cache::put($this->cache_key.$id, $homework_get, $this->cache_time);
    }

}