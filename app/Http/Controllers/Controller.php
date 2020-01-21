<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
    1. JSON_UNESCAPED_UNICODE: 遇到中文跳过Unicode编码,直接显示！
    2. JSON_NUMERIC_CHECK：数字不要加双引号!
    3. JSON_PRESERVE_ZERO_FRACTION: JSON保留零分数!
    */
    public static function json($data) {
        return response()->json($data, 200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK|JSON_PRESERVE_ZERO_FRACTION);
    }
}
