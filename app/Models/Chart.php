<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    //注入信息
    protected $fillable=['chart_type','chart_id','user_id','content'];
    //
    public function chart()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
