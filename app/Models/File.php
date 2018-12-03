<?php

namespace App\Models;



use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    protected $table='files';
    protected $fillable=['name','path','url','type','file_size','pid'];

    /**
     * 获取文件（多态）
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function filetable()
    {
        return $this->morphTo();
    }
}
