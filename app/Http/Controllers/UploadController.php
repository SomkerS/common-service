<?php

namespace App\Http\Controllers;

use App\Service\UploadImagesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UploadController extends AppBaseController
{

    /**
     * 上传图片
     *
     * @param Request $request
     * @return void
     */
    public function uploadImages(Request $request)
    {
        // 接收表单数据
        $param = $request->all();

        // 验证数据
        $validator = Validator::make(
            $param,
            [
                'image' => 'required|file',
            ]
        );

        if ($validator->fails()) {
            return $this->failResponse($validator->errors()->toArray());
        }
        
        $image = $request->file('image');
        $file_name = Str::random(16) . '.' . $image->extension();

        $image = UploadImagesService::saveImage($image, $file_name);
        return $this->successResponse($image);
    }
}