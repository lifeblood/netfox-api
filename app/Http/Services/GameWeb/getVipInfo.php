<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 10:33
 */

namespace App\Http\Services\GameWeb;

use App\Http\Models\GameWeb\PlatformDataProvider;
use App\Http\Models\GameWeb\TreasureDataProvider;


class getVipInfo
{
    /**
     * 获取VIP信息
     * @param $request
     * @return array
     */
    public static function getVipInfo($request)
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
}