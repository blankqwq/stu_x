<?php

namespace App\Models;


class Homework extends Model
{
    protected $table='homeworks';
    protected $fillable=['teacher_id', 'class_id', 'title', 'content', 'start_time', 'stop_time',];

    /**
     * 发布者
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function publisher(){
        return $this->hasOne(User::class,'id','teacher_id');
    }

    /**
     * 所在班级
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function classes(){
        return $this->hasOne(Classes::class,'id','class_id');
    }

    /**
     * 收到的作业份数
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posters(){
        return $this->hasMany(StuHomework::class,'homework_id','id');
    }
}
