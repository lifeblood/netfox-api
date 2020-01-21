<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/21
 * Time: 14:58
 */

namespace App\Http\Services\GameWeb;

use Illuminate\Support\Facades\DB;


class NativeWebDataProvider
{
    private static $db = 'WHQJNativeWebDB';

    /**
     * 获取分享玩家彩金数据
     * @return array
     */
    public static function GetShareRewardData() {
        $res = DB::connection(self::$db)->table('ShareConfig')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->where('ID', '=', 1)
            ->first();
        $res->ID = 0;
        $data   = [
            'code' => 0,
            'msg'  => '',
            'data' => [
                'apiVersion' => 20200118,
                'valid'      => true,
                'list'     => [$res]
            ]
        ];
        return $data;
    }

    public static function GetDayRankingData($userId, $typeId)
    {
        $type   = [1 => null, 2 => null];
        $params = [':UserID' => $userId, ':TypeID' => $typeId];
        try {
            $type[$typeId] = DB::connection(self::$db)->select("exec NET_PW_GetDayRankingData :UserID, :TypeID", $params);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 'IMSSP') {   //SQLSTATE[IMSSP]: The active result for the query contains no fields.
                $type[$typeId] = [];
            }
        }
        $isRank = count($type[$typeId]) ? true : false;
        $data   = [
            'code' => 0,
            'msg'  => '',
            'data' => [
                'apiVersion' => 20200118,
                'valid'      => true,
                'IsRank'     => $isRank,
                'WealthRank' => $type[1],
                'GameRank'   => $type[2]
            ]
        ];
        return $data;
    }
}