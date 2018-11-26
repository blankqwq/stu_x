<?php

namespace App\Models;


class Classes extends Model
{
    protected $fillable = ['avatar','type_id', 'name', 'user_id','numbers',
        'verification', 'password', 'user_allow',];


    /**
     * 班级类型
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type(){
        return $this->hasOne(ClassType::class,'id','type_id');
    }

    /**
     * 创建者
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator(){
        return $this->hasOne(User::class,'id','user_id');
    }

    /**
     * 班级下的所有学生
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function student(){
        return $this->belongsToMany(User::class,'class_users','class_id','user_id');
    }

    /**
     * 获取当前班级的所有学生
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function homeworks(){
        return $this->hasMany(Homework::class,'class_id','id');
    }

    /**
     * 班级下的文件
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function files(){
        return $this->morphMany(File::class,'filetable');
    }


    public function notices(){
        return $this->hasMany(Topic::class,'class_id','id')
            ->where('type_id',1)->orWhere('type_id',0);
    }

    public function needs(){
        return $this->hasMany(Topic::class,'class_id','id')->where('type_id',2);
    }

}
