<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/21
 * Time: 12:29
 */

namespace App\Http\Models\GameWeb;

use Illuminate\Support\Facades\Redis;

class RedisDataProvider
{
    /**
     * 获取Redis数据
     * @return array
     */
    public static function getRedisTurntableMsg()
    {
        $openListKey = config('NetFox.redisPrefix') . ':getturntablemsg:openList';
        $bigListKey  = config('NetFox.redisPrefix') . ':getturntablemsg:bigList';
        $nList       = Redis::lrange($openListKey, 0, 19);
        $openList    = [];
        foreach ($nList as $data) {
            array_push($openList, json_decode($data, true));
        }
        $bList   = Redis::lrange($bigListKey, 0, 19);
        $bigList = [];
        foreach ($bList as $data) {
            array_push($bigList, json_decode($data, true));
        }
        $data = [
            'code' => 0,
            'msg'  => '',
            'data' => [
                'apiVersion' => 20200118,
                'valid'      => true,
                'openList'   => $openList,
                'bigList'    => $bigList
            ]
        ];
        return $data;
    }
}