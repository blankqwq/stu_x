<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    //
    protected $fillable=[
        'topic_id','user_id','content','pid'
    ];
    public function topics(){
        return $this->belongsTo(Topic::class,'topic_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
