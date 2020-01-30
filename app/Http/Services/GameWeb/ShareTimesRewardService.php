<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 14:14
 */

namespace App\Http\Services\GameWeb;


use App\Http\Models\GameWeb\NativeWebDataProvider;
use App\Http\Services\BaseService;

class ShareTimesRewardService extends BaseService
{
    /**
     * 分享时间奖励
     * @param $request
     * @return mixed
     */
    public static function shareTimesReward($request) {
        $userId = $request->input('userid');
        $clientIP = $request->getClientIp();
        $list = NativeWebDataProvider::getTimesReward($userId, $clientIP);
        $data = self::getJsonSuccess();
        $data['data'] =[
            'apiVersion' => '20200123',
            'valid'      => false,
            'rs'      => -1,
            'TimeShareGold'      => 0,
            'TimeShareDiamond'      => 0,
        ];

        if ($list) {
            $data['data'] =[
                'apiVersion' => '20200123',
                'valid'      => true,
                'rs'      => $list->rst,
                'TimeShareGold'      => $list->TimeShareGold,
                'TimeShareDiamond'      => $list->TimeShareDiamond
            ];
        }
        return $data;
    }
}