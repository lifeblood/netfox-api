<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 11:31
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\RedisDataProvider;

class GetTurnTableMsgService
{
    /**
     * 获得排名数据
     * @return array
     */
    public static function getTurnTableMsg() {
        return RedisDataProvider::getRedisTurntableMsg();
    }
}