<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/27
 * Time: 13:41
 */

namespace App\Http\Services\GameWeb;



use App\Http\Models\GameWeb\TreasureDataProvider;
use App\Http\Services\BaseService;

class getReward extends BaseService
{
    public static function getReward($request) {
        $userId = $request->input('userid');
        $msg = TreasureDataProvider::getReward($userId);
        $isSuccess = $msg == '领取成功' ? true : false;
        $data         = self::getJsonSuccess();
        $data['msg'] = $msg;
        $data['data'] = [
            'apiVersion' => '20200123',
            'valid'      => $isSuccess,
        ];
        return $data;
    }
}