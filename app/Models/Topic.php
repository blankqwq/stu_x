<?php

namespace App\Models;


class Topic extends Model
{
    protected $fillable=['type_id', 'title', 'content', 'level',
        'user_id', 'class_id', 'att_name','att_url', 'can_reply',
];

    /**
     * 获取回复
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(){
        return $this->hasMany(Replies::class,'topic_id','id');
    }

    /**
     * 获取发送人的信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classes(){
        return $this->belongsTo(Classes::class,'class_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(){
        return $this->belongsTo(TopicType::class,'type_id','id');
    }
    //
}
