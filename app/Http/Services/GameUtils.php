<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/20
 * Time: 12:03
 */

namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class GameUtils
{
    private static $multiple = 1000;


    /**
     * 构造订单号 (形如:20101201102322159111111)
     * @param $prefix
     * @return bool|string
     */
    public static function getOrderIDByPrefix($prefix) {
        $defaultLength = 9;  // 32-9 = 23
        $currentTime = Carbon::now()->format('YmdHisu') . rand(100, 999); // 20 +3 = 23
        $tradeNoBuffer = $prefix . $currentTime;
        $offset = strlen($prefix) - $defaultLength;
        if ($offset > 0) {
            $tradeNoBuffer = substr($tradeNoBuffer,0, -$offset);
        }
        return $tradeNoBuffer;
    }


    /**
     * 1. JSON_UNESCAPED_UNICODE: 遇到中文跳过Unicode编码,直接显示！
       2. JSON_NUMERIC_CHECK：数字不要加双引号!
       3. JSON_PRESERVE_ZERO_FRACTION: JSON保留零分数!
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function json($data) {
        return response()->json($data, 200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK|JSON_PRESERVE_ZERO_FRACTION);
    }


    /**
     * @return string
     */
    public static function getLineMsg() {
        return __CLASS__ .' / '. __FUNCTION__ .' / '. __LINE__.': ';
    }








    /**
     * 获取VIP信息
     * @param $request
     * @return array
     */
    public static function getVipInfoData($request)
    {
        $userId     = $request->all()['userid'];
        $userVipArr = [
            'Exp' => 0, 'VipLevel' => 0, 'FresReward' => 0, 'DayReward' => 0, 'WeekReward' => 0, 'MonthReward' => 0];

        $records = PlatformDataProvider::GetVipConfig();
        foreach ($records as $key => $data) {
            $records[$key]->Integral = isset($records[$key + 1]->Integral) ? $records[$key + 1]->Integral : $records[$key]->Integral;
        }

        $userVip = TreasureDataProvider::getUserVipInfo($userId);
        if ($userVip) {
            $userVipArr = [
                'VipLevel'    => $userVip->VipLevel,
                'FresReward'  => $userVip->FresReward,
                'WeekReward'  => $userVip->WeekReward,
                'MonthReward' => $userVip->MonthReward,
                'Exp'         => $userVip->Score / self::$multiple,
                'DayReward'   => $userVip->VipLevel,
            ];
        }
        $data = [
            'code' => 0,
            'msg'  => '',
            'data' => [
                'apiVersion' => 20200118,
                'valid'      => true,
                'records'    => $records,
                'userVip'    => $userVipArr
            ]
        ];
        return $data;
    }

    //创建转盘
    public static function CreatTurnTable($request)
    {
        $index    = (int)$request->all()['index'];
        $userId   = $request->all()['userid'];
        $list     = PlatformDataProvider::GetTurntableConfigs();
        $validBet = TreasureDataProvider::GetValidBetByUid($userId);

        if (intval($validBet->GrandScore) < intval($list[$index * 5]->MenuVaule * self::$multiple)) {
            $jsonMSG        = config('NetFox.jsonMSG');
            $jsonMSG['msg'] = '积分不足';
            return $jsonMSG;
        }

        $money = $list[$index * 5];    //奖金
        $broad = $list[5 * $index + 2];   //是否大奖
        //0:白银转盘/1:黄金转盘/other:钻石转盘
        $tName  = config('NetFox.turnName.' . $index) ?? config('NetFox.turnName.3');
        $randId = rand(1, 13);  // 产生1-13随机数
        $reward = $money->{'Value' . $randId};
        $bBord  = (int)$broad->{'Value' . $randId};
        $score  = $money->MenuVaule * self::$multiple;
        try {
            //写入存储过程
            TreasureDataProvider::DealTurnTable($userId, $tName, $index, $randId, $reward * self::$multiple, $score);
            $lastScore = $validBet->GrandScore - $score;  //剩余金币
            $userInfo  = AccountsDataProvider::GetAccountsInfoByUserID($userId);
            //写入REDIS, 最新20条，给getturntablemsg方法使用
            $record = [
                'money'    => $reward,
                'time'     => Carbon::now()->toDateTimeString(),
                'turnName' => $tName,
                'nickName' => $userInfo->NickName
            ];
            TreasureDataProvider::PushTurnTableRecord($record, $bBord);
            $data = [
                'code' => 0,
                'msg'  => '',
                'data' => [
                    'apiVersion' => 20200118,
                    'valid'      => true,
                    'pos'        => $randId,
                    'Score'      => $lastScore
                ]
            ];
        } catch (\Illuminate\Database\QueryException $e) {
            //if ($e->getCode() == 'HY093') {
            $data        = config('NetFox.jsonMSG');
            $data['msg'] = '写入存储过程失败, 请联系管理员!';
            //}
        }
        return $data;
    }


    //创建转盘日期
    public static function CreatTurnTableDate()
    {
        $list      = PlatformDataProvider::GetTurntableConfigs();
        $pp        = rand(0, 100);
        $turnIndex = 0;
        if ($pp > $list[2]->MenuVaule && $pp < $list[7]->MenuVaule) {
            $turnIndex = 1;
        } else if ($pp > $list[7]->MenuVaule) {
            $turnIndex = 2;
        }
        $Android = AccountsDataProvider::getRandomAndroid();
        dd($mm);
    }
}