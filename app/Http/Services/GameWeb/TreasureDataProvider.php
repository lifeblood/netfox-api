<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/20
 * Time: 14:38
 */

namespace App\Http\Services\GameWeb;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;


class TreasureDataProvider
{
    private static $db = 'WHQJTreasureDB';
    private static $redisLimit = 19;

    public static function GetValidBetByUid($userId)
    {
        $res = DB::connection(self::$db)->table('UserValidBet')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->where('UserID', '=', $userId)
            ->first();
        return $res;
    }

    //存入Redis
    public static function PushTurnTableRecord($record, $bBord) {
        $openListKey = config('NetFox.redisPrefix').':getturntablemsg:openList';
        $bigListKey = config('NetFox.redisPrefix').':getturntablemsg:bigList';
        Redis::lpush($openListKey, json_encode($record));
        Redis::ltrim($openListKey, 0, self::$redisLimit);
        if ($bBord == 1) {
            Redis::lpush($bigListKey, json_encode($record));
            Redis::ltrim($bigListKey, 0, self::$redisLimit);
        }
    }

    public static function DealTurnTable($uid, $tableName, $index, $open, $reward, $score)
    {
        $params = [
            ':dwUserID'        => $uid,
            ':Reward'          => $reward,
            ':Score'           => $score,
            ':TableIndex'      => $index,
            ':Open'            => $open,
            ':TableName'       => $tableName,
            'strErrorDescribe' => 127
        ];
        $res    = DB::connection(self::$db)->update("exec NET_PW_TurnTable :dwUserID, :Reward, 
                                                :Score, :TableIndex, :Open, :TableName, :strErrorDescribe output", $params);
        return $res;
    }

    /**
     * 获取UserVipInfo
     * @return string
     */
    public static function getUserVipInfo($userId)
    {
        $res = DB::connection(self::$db)->table('UserVipInfo')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->where('UserID', '=', $userId)
            ->first();
        return $res;
    }
}