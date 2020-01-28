<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 12:11
 */

namespace App\Enums;


use BenSampo\Enum\Enum;

/**
 * 金币流水类型枚举
 */
class ApiCode extends Enum
{

    /** 成功 */
    const Success = 0;
    /** 抱歉，接口认证失败 */
    const UNAUTHORIZED = 401;
    /** 抱歉，接口系统错误 */
    const LogicErrorCode = 500;
    /** 抱歉，接口签名错误 */
    const VeritySignErrorCode = 2001;
    /** 抱歉，接口参数错误 */
    const VerityParamErrorCode = 2002;
}