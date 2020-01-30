<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 19:45
 */

namespace App\Http\Services\GameWeb;


use App\Http\Models\GameWeb\TreasureDataProvider;
use App\Http\Services\BaseService;

class GetVipRewardService extends BaseService
{
    /**
     * 获得VIP奖励
     * @param $request
     * @return array
     */
    public static function getVipReward($request) {
        $userId = $request->input('userid');
        $type = $request->input('type');
        $IP = $request->getClientIp();
        $list = TreasureDataProvider::getVipReward($userId, $type, $IP);
        $data = [
            'code' => 0,
            'msg' =>$list->customResult == null ? '' : $list->customResult ,
            'data' => [
                'apiVersion' => 20200128,
                'valid' => true,
                'reward' => $list->Rewards
            ]
        ];
        return $data;
    }
}