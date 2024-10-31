<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

class UploadImagesService
{
    const UPLOAD_IMAGE_PATH = 'public/images';

    /**
     * 上传图片
     *
     * @param [type] $image
     * @return void
     */
    public static function saveImage($image, $file_name)
    {
        if (Storage::disk('public')->exists('images/' . $file_name)) {
            // 如果存在，则删除它
            Storage::disk('public')->delete('images/' . $file_name);
        }

        //$file_name = $image->storeAs(self::UPLOAD_IMAGE_PATH, $file_name);
        $path = $image->store('images', 'public');
        $file_name = url('storage/'.$path);

        return $file_name;
    }
}
