<?php

namespace App\Models;



class File extends Model
{
    /**
     * 获取文件（多态）
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function filetable()
    {
        return $this->morphTo();
    }
}
