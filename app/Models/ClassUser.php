<?php

namespace App\Models;


class ClassUser extends Model
{
    protected $table="class_users";
    protected $fillable=['user_id','class_id','token'];
    //
}
