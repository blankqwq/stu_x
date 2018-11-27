<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable {
        notify as protected laraNotify;
    }
    use HasRoles;
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','sex','avatar','sign'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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

    public function classe(){
        return $this->hasOne(Classes::class,'user_id');
    }

    /**
     * 获取全部班级
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

    public function notify($instance)
    {
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laraNotify($instance);
    }
}
