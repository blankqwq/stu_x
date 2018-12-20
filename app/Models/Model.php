<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25
 * Time: 16:29
 */

namespace App\Models;

class Model extends \Illuminate\Database\Eloquent\Model
{
    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeLevel($query){
        return $query->orderBy('level', 'desc')->orderBy('created_at','desc');
    }

}