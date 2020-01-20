<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/20
 * Time: 12:03
 */

namespace App\Http\Services;
use App\Http\Services\GameWeb\AccountsDataProvider;
use App\Http\Services\GameWeb\PlatformDataProvider;
use App\Http\Services\GameWeb\TreasureDataProvider;
use Illuminate\Support\Str;


class FacadeManager
{
    private static $multiple = 1000;

    //创建转盘
    public static function CreatTurnTable($request)
    {
        $index   = (int)$request->all()['index'];
        $userId = $request->all()['userid'];
        $list =  PlatformDataProvider::GetTurntableConfigs();
        $validBet = TreasureDataProvider::GetValidBetByUid($userId);

        if (intval($validBet->GrandScore) < intval($list[$index * 5]->MenuVaule * self::$multiple))
        {
            $jsonMSG = config('NetFox.jsonMSG');
            $jsonMSG['msg'] = '积分不足';
            return $jsonMSG;
        }

        $userInfo = AccountsDataProvider::GetAccountsInfoByUserID($userId);

        $money = $list[$index * 5];    //奖金
        $broad = $list[5 * $index + 2];   //是否大奖
        $tName = config('NetFox.turnName.'.$index) ?? config('NetFox.turnName.3'); //0:白银转盘/1:黄金转盘/other:钻石转盘

        $randId = rand(1,13);
        $reward = $money->{'Value'.$randId};

        $score = $money->MenuVaule * self::$multiple;
        $lastScore = $validBet->GrandScore - $score;

        $sp = TreasureDataProvider::DealTurnTable($userId, $tName, $index, $randId,
            $reward * self::$multiple, $score);

        $data     = [
            'code'        => 0,
            'msg'         => '',
            'data' => [
                'apiVersion'  => 20200118,
                'valid'       => true,
                'pos'       => $randId,
                'Score'       => $lastScore
            ]
        ];
        return $data;
    }

    //创建转盘日期
    public static function CreatTurnTableDate() {
        $list =  PlatformDataProvider::GetTurntableConfigs();
        $pp = rand(0,100);
        $turnIndex = 0;
        if ($pp > $list[2]->MenuVaule && $pp < $list[7]->MenuVaule)
        {
            $turnIndex = 1;
        }
        else if ($pp > $list[7]->MenuVaule)
        {
            $turnIndex = 2;
        }
        $Android = AccountsDataProvider::getRandomAndroid();
        dd($mm);
    }
}