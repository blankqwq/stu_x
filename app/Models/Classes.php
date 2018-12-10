<?php

namespace App\Models;


class Classes extends Model
{
    protected $fillable = ['avatar','type_id', 'name', 'user_id','numbers',
        'verification', 'password', 'user_allow',];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(){
        return $this->belongsTo(ClassType::class,'type_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(){
        return $this->belongsTo(User::class,'user_id','id');
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

    public function chart(){
        return $this->morphMany(Chart::class,'chart');
    }
}
