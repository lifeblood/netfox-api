<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 11:31
 */

namespace App\Http\Services\GameWeb;


class getTurnTableMsg
{
    public static function getTurnTableMsg() {
        return RedisDataProvider::getRedisTurntableMsg();
    }
}