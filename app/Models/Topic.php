<?php

namespace App\Models;


class Topic extends Model
{
    protected $fillable=['type_id', 'title', 'content', 'level',
        'user_id', 'class_id', 'att_name','att_url', 'can_reply',
];

    public function replies(){
        return $this->hasMany(Replies::class,'topic_id','id');
    }

    public function sender(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function type(){
        return $this->hasOne(TopicType::class,'id','type_id');
    }
    //
}
