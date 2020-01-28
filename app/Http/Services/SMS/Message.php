<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/27
 * Time: 16:35
 */

namespace App\Http\Services\SMS;



/**
 * PHP设计模式之策略(strategy)模式
 */
interface  Message
{

    /**
     * @param $mobile
     * @return mixed
     */
    public function send($mobile);
}