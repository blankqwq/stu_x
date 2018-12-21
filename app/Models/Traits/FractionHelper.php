<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/21
 * Time: 14:32
 */

namespace App\Models\Traits;


use App\Models\ClassUser;
use App\Models\Homework;
use App\Models\StuHomework;
use Illuminate\Support\Facades\Cache;

trait FractionHelper
{
    /**
     * @var string
     * 缓存所有作业的平均分，然后按需获取即可
     */
    protected $cache_key='cache_homework_fraction_';

    protected $cache_time=120;

    public function getFraction($id)
    {
        return Cache::remember($this->cache_key.$id, $this->cache_time, function() use ($id){
            return $this->caculateFraction($id);
        });
    }

    public function calculateAndCacheFraction($id)
    {
        $fraction_get = $this->caculateFraction($id);
        $this->cacheFraction($id,$fraction_get);
    }

    public function caculateFraction($id){
        $fraction_get = collect();
        $fractions = StuHomework::select('fraction')->where('homework_id',$id)->get()->toArray();
        foreach ($fractions as $fraction){
            $fraction_get = $fraction_get->push($fraction["fraction"]);
        }
        if ($fractions) {
            $fraction_get=$fraction_get->avg();
        }
        return $fraction_get;
    }
    public function caculateAllFraction(){
        $homework_ids=$this->all(['id']);

        foreach ($homework_ids as $homework_id){
            $this->calculateAndCacheFraction($homework_id->id);
        }
    }


    private function cacheFraction($id,$fraction_get)
    {
        // 将数据放入缓存中
        Cache::put($this->cache_key.$id, $fraction_get[$id], $this->cache_time);
    }

}