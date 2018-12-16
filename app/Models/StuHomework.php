<?php

namespace App\Models;


class StuHomework extends Model
{
    //作业提交的模型
    protected $fillable=['content','attachment','homework_id','user_id','fraction','comment'];

    public function homework(){
        return $this->belongsTo(Homework::class,'homework_id','id');
    }

    public function poster(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
