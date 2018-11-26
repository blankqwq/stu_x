<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/25
 * Time: 14:44
 */

namespace App\Handlers;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageUploadHandler
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function save($file, $folder, $file_prefix,$max_width = false)
    {
        // 按照月/日期文件夹切割能让查找效率更高。
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        // 文件具体存储的物理路径
        $upload_path =  '/' . $folder_name;

        // 获取文件的后缀名
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名，
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 将图片移动到我们的目标存储路径中
        $res=Storage::disk('public')->putFileAs(
            $upload_path, $file, $filename
        );
        if ($max_width && $extension != 'gif') {
            try{
                $this->reduceSize('storage'.$upload_path . '/' . $filename, $max_width);

            }catch (\Exception $exception){

            }
        }

        return [
            'path' =>  "/storage/$folder_name/$filename"
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make($file_path);

        // 进行大小调整的操作
        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 对图片修改后进行保存
        $image->save();
    }
}