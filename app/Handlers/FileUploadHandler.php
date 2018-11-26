<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 14:28
 */

namespace App\Handlers;


use Illuminate\Support\Facades\Storage;

class FileUploadHandler
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg','zip','7z','mp4'];

    public function save($file, $folder, $file_prefix)
    {
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        $upload_path =  '/' . $folder_name;

        // 获取文件的后缀名
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'zip';

        // 拼接文件名，
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 将图片移动到我们的目标存储路径中
        $res=Storage::disk('public')->putFileAs(
            $upload_path, $file, $filename
        );

        return [
            'path' =>  "/storage/$folder_name/$filename",
            'name'=>$file->getClientOriginalName(),
        ];
    }

}