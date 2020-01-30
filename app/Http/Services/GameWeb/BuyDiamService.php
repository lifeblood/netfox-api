<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 14:54
 */

namespace App\Http\Services\GameWeb;


use App\Http\Models\GameWeb\TreasureDataProvider;
use App\Http\Services\BaseService;

class BuyDiamService extends BaseService
{
    /**
     * 金币购买
     * @param $request
     * @return array|mixed
     */
    public static function buyDiam($request) {
        $userId = $request->input('userid');
        $number = $request->input('number', 0);
        if ($number < 0) {
            $data = self::getJsonFails();
            $data['msg'] = '兑换量必须大于0！';
            return $data;
        }
        $list = TreasureDataProvider::buyDiam($userId, $number);
        $data = self::getJsonSuccess();
        $data = [
            'code' => $list->res,
            'msg'  => $list->customResult,
            'data' => [
                'apiVersion' => 20200128,
                'valid'      => $list->res == 0 ? true : false
            ]
        ];
        return $data;
    }
}