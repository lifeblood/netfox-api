<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/23
 * Time: 17:06
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\TreasureDataProvider;


use App\Http\Services\BaseService;
use App\Http\Services\GameUtils;

class imgPay extends BaseService
{
    public static function imgPay($request) {
        $userId = $request->all()['userid'];
        $cfgID = $request->all()['cfgID'] ?? 1;
        $payLink = $request->all()['payLink'];
        $amount = $request->all()['amount'] ?? 0;
        $payName = $request->all()['payName'];
        $orderID = GameUtils::getOrderIDByPrefix('QRPay');
        $msg = TreasureDataProvider::creatImgPayOrder($userId, $cfgID, $payLink, $amount, $payName, $orderID);
//        dd($msg);
        $data         = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion' => '20200123',
            'valid'      => true
        ];
        return $data;
    }
}