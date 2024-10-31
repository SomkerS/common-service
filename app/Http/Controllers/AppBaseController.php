<?php

namespace App\Http\Controllers;

use Response;

class AppBaseController extends Controller
{
    //
    public function makeResponse($result, $message, $code)
    {
        return [
            'status_code' => $code,
            'data'    => $result,
            'message' => $message,
        ];
    }

    public function failResponse($message, $code = 400)
    {
        /*if ($message instanceof MessageBag) {
            $message = formatErrors($message);
        }*/
        $message = $this->formatErrors($message);

        $payload = $this->makeResponse([], $message, $code);
        $header = [];
        /*if ($token = JWTAuth::getToken()) {
            $header = [
                'Access-Control-Expose-Headers' => 'Authorization,Token-Refresh-At',
                'Authorization' => $token,
                'Token-Refresh-At' => Carbon::now()->timestamp,
            ];
        }*/
        return Response::json($payload, $code, $header, JSON_UNESCAPED_UNICODE);
    }

    public function successResponse($result = [], $message = "操作成功", $status = 200)
    {
        $payload = $this->makeResponse($result, $message, $status);
        $header = [];
        /*if ($token = JWTAuth::getToken()) {
            $header = [
                'Access-Control-Expose-Headers' => 'Authorization,Token-Refresh-At',
                'Authorization' => $token,
                'Token-Refresh-At' => Carbon::now()->timestamp,
            ];
        }*/
        return Response::json($payload, $status, $header, JSON_UNESCAPED_UNICODE);
    }

    public function formatErrors($message)
    {
        if (is_array($message)) {
            foreach ($message as $k => $v) {
                $message = isset($v[0])?$v[0]:$v;
                break;
            }
        }
        return $message;
    }
}
