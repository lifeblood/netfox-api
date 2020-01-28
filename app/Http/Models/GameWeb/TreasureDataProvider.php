<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/20
 * Time: 14:38
 */

namespace App\Http\Models\GameWeb;

use App\Http\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;


class TreasureDataProvider extends BaseService
{
    private static $db = 'WHQJTreasureDB';
    private static $redisLimit = 19;
    private static $pageLimit = 6;

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
    public static function PushTurnTableRecord($record, $bBord)
    {
        $openListKey = config('NetFox.redisPrefix') . ':getturntablemsg:openList';
        $bigListKey  = config('NetFox.redisPrefix') . ':getturntablemsg:bigList';
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


    /**
     * @param $userId
     * @param $index
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getPayRecord($userId, $index)
    {

        //三张表联合查询
        $imgPayOrder = DB::connection(self::$db)->table('ImgPayOrder')
            ->lock('WITH(NOLOCK)')
            ->select('Amount as aaa', 'OrderStates', 'PayTime')
            ->selectRaw('type =1')
            ->where('UserID', '=', $userId);

        $bankPayOrder = DB::connection(self::$db)->table('BankPayOrder')
            ->select('Amount', 'OrderStates', 'PayTime')
            ->selectRaw('type =2')
            ->where('UserID', '=', $userId)
            ->union($imgPayOrder);

        $onLineOrder = DB::connection(self::$db)->table('OnLineOrder')
            ->select('OrderAmount AS Amount', 'OrderStatus AS OrderStates', 'ApplyDate AS PayTime')
            ->selectRaw('type =3')
            ->where('UserID', '=', $userId)
            ->where('OrderStatus', '>', 0)
            ->union($bankPayOrder);

        $querySql = $onLineOrder->toSql();

        $result = DB::connection(self::$db)->table(DB::raw("($querySql) as a"))
            ->mergeBindings($onLineOrder)
            ->orderBy('PayTime', 'DESC')
            ->paginate(self::$pageLimit, ['*'], 'index', $index);
        //->skip($offset)->take(self::$pageLimit);

        return $result;
    }


    /**
     * 线上充值
     * @param $payType
     * @return string
     */
    public static function getOnLinePayList($payType)
    {
        $res = DB::connection(self::$db)->table('OnlinePayConfig')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->where('PayType', '=', $payType)
            ->where('Nullity', '=', 0)
            ->orderByDesc('PayIdentity')
            ->orderByDesc('SortID')
            ->get();
        return $res;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public static function getBankPayList()
    {
        $res = DB::connection(self::$db)->table('OfficalBankPay')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->where('Nullity', '=', 0)
            ->orderByDesc('SortID')
            ->get();
        return $res;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public static function getImgPayList()
    {
        $res = DB::connection(self::$db)->table('OfficalImgPay')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->where('Nullity', '=', 0)
            ->orderByDesc('SortID')
            ->get();
        return $res;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function getOnLineWeChatList()
    {
        $res = DB::connection(self::$db)->table('OnLineWeChat')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->where('Nullity', '<>', 1)
            ->get();
        foreach ($res as $key => $data) {
            $res[$key]->CollectDate = Str::substr($data->CollectDate, 0, 19);
        }
        return $res;
    }

    /**
     * @param $userId
     * @return array
     */
    public static function getUserWealth($userId)
    {

        $res = DB::connection(self::$db)->select("SELECT ISNULL(G.Score,0) AS Score,ISNULL(G.InsureScore,0) AS 
                InsureScore,ISNULL(U.Diamond,0) AS Diamond,ISNULL(U.AwardTicket,0) AS AwardTicket FROM 
                (SELECT UserID,Score,InsureScore FROM GameScoreInfo WHERE UserID=?) AS G FULL JOIN 
                (SELECT UserID,Diamond,AwardTicket FROM UserCurrency WHERE UserID=?) AS U ON G.UserID=U.UserID", [$userId, $userId]);
        return $res;
    }

    /**
     * @param $userId
     * @return array|mixed|null
     */
    public static function getAgentInfo($userId)
    {
        $params = [':dwUserID' => $userId];
        $data   = [];
        try {
            $data = DB::connection(self::$db)->select("exec NET_PW_GetAgentInfo :dwUserID", $params);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 'IMSSP') {   //SQLSTATE[IMSSP]: The active result for the query contains no fields.

            }
        }
        $data = empty(current($data)) ? null : current($data);
        return $data;
    }

    /**
     * @param $userId
     * @param $type
     * @return \Illuminate\Support\Collection
     */
    public static function getAgentRank($userId, $type)
    {
        $arr = [
            '1' => 'DayReward',
            '2' => 'WeekReward',
            '3' => 'MonthReward',
        ];
        isset($arr[$type]) ? $arr[$type] : 'DayReward';

        $res = DB::table(self::$db . '.dbo.AgentRank as a')
            ->join('WHQJAccountsDB.dbo.AccountsInfo as r', 'a.UserID', '=', 'r.UserID')
            ->select('r.NickName as Name', 'a.' . $arr[$type] . ' as Reward', 'r.GameID as GameId')
            //->where('r.UserID','=', $userId)
            ->orderByDesc('a.' . $arr[$type])
            ->skip(0)->take(10)
            ->get();
        return $res;
    }

    /**
     * @param $userId
     * @param $type
     * @return int|mixed
     */
    public static function getAgentRankCount($userId, $type)
    {
        $arr = [
            '1' => 'DayReward',
            '2' => 'WeekReward',
            '3' => 'MonthReward',
        ];
        isset($arr[$type]) ? $arr[$type] : 'DayReward';
        $res   = DB::connection(self::$db)->table('AgentRank')
            ->select($arr[$type] . ' as OwnReward')
            ->where('UserID', '=', $userId)
            ->pluck('OwnReward')
            ->first();
        $count = $res == null ? 0 : $res;
        return $count;
    }

    public static function creatImgPayOrder($userId, $cfgID, $payLink, $amount, $payName, $orderID)
    {
        $params = [
            ':dwUserID'  => $userId,
            ':cfgID'     => $cfgID,
            ':payLink'   => $payLink,
            ':amount'    => $amount,
            ':payName'   => $payName,
            ':strOrderID'    => $orderID,
            'strErrorDescribe'    => 127,
        ];
        $res    = DB::connection(self::$db)->statement("exec NET_PW_CreateImgPayOrder :dwUserID, :cfgID,
                :payLink, :amount, :payName, :strOrderID, :strErrorDescribe output", $params);
        return $res;
    }


    /**
     * 领取奖励
     * @param $userId
     * @return bool
     */
    public static function getReward($userId) {
        $params = [
            ':dwUserID'  => (int)$userId,
           // ':strErrorDescribe'    => '',
        ];
        $res    = DB::connection(self::$db)->select("DECLARE @customResult NVARCHAR(127);
        exec NET_PJ_GetReward @dwUserID=:dwUserID, @strErrorDescribe=@customResult OUTPUT; select @customResult as customResult", $params);
//        dd($res);
        return current($res)->customResult;

    }
}












