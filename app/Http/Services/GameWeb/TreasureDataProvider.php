<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/20
 * Time: 14:38
 */

namespace App\Http\Services\GameWeb;
use Illuminate\Support\Facades\DB;


class TreasureDataProvider
{
    private static $db = 'WHQJTreasureDB';

    public static function GetValidBetByUid($userId) {
        $res = DB::connection(self::$db)->table('UserValidBet')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->where('UserID', '=', $userId)
            ->first();
        return $res;
    }

    public static function DealTurnTable($uid, $tableName, $index, $open, $reward, $score) {
        $params = [
            ':dwUserID' => $uid,
            ':Reward' => $reward,
            ':Score' => $score,
            ':TableIndex' => $index,
            ':Open' => $open,
            ':TableName' => $tableName,
            'strErrorDescribe' => 127
        ];
        $res = DB::connection(self::$db)->update("exec NET_PW_TurnTable :dwUserID, :Reward, 
                                                :Score, :TableIndex, :Open, :TableName, :strErrorDescribe output",$params);
        return $res;
    }
}