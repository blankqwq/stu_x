<?php

namespace App\Models;

use App\Notifications\ClassCreate;
use App\Notifications\NewStuJinClass;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable {
        notify as protected laraNotify;
    }
    use HasRoles;
    protected $guard_name = 'web';

    protected $fillable = [
        'name', 'email', 'password','sex','avatar','sign'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 获取已加入的班级
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function classes(){
        return $this->belongsToMany(Classes::class,'class_users','user_id','class_id')->wherePivot('token', null);;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classe(){
        return $this->hasMany(Classes::class,'user_id','id')->where('user_allow','>',0);
    }

    /**
     * 获取全部加入或正在加入的班级
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notclasses(){
        return $this->belongsToMany(Classes::class,'class_users','user_id','class_id');
    }

    /**
     * 获取个人的文件夹
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function files(){
        return $this->morphMany(File::class,'filetable');
    }

    /**
     * 消息系统的功能
     * @param $instance
     */
    public function notify($instance)
    {
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laraNotify($instance);
    }

    /**
     * 判断是否是文章的作者
     * @param $model
     * @return bool
     */
    public function isAuthOf($model){
        return $this->id === $model->user_id;
    }

    /**
     * 是否属于班级中的人
     * @param $id
     * @return bool
     */
    public function isClassOf($id)
    {
        return $this->classes()->wherePivot('class_id',$id)->count()>0;
    }

    /**
     * 设定已阅读的的文章
     */
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications()->where('type','<>',NewStuJinClass::class)->where('type','<>',ClassCreate::class)
            ->update(['read_at' => Carbon::now()]);
    }

}
