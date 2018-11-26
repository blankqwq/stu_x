<?php

namespace App\Models;


class ClassType extends Model
{
    protected $table='class_types';
    protected $fillable=['category',''];

    /**
     * 获取当前分类下的所有班级
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classes(){
        return $this->belongsTo(Classes::class,'type_id','id');
    }
}
