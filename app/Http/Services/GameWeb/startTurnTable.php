<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 11:27
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\TreasureDataProvider;
use App\Http\Models\GameWeb\PlatformDataProvider;
use App\Http\Models\GameWeb\AccountsDataProvider;
use Carbon\Carbon;


class startTurnTable
{
    private static $multiple = 1000;
    //创建转盘
    public static function startTurnTable($request)
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
}