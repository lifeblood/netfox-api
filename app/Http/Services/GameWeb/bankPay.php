<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 18:48
 */

namespace App\Http\Services\GameWeb;


use App\Http\Models\GameWeb\TreasureDataProvider;
use App\Http\Services\BaseService;
use App\Http\Services\GameUtils;

class bankPay extends BaseService
{
    public static function bankPay($request)
    {

        $orderID = GameUtils::getOrderIDByPrefix('BKPay');
        $params  = [
            ':dwUserID'     => $request->input('userid'),
            ':cfgID'        => $request->input('cfgID', 1),
            ':Number'       => $request->input('bankAcc'),
            ':amount'       => $request->input('amount', 0),
            ':payName'      => $request->input('payName'),
            ':payBank'      => $request->input('bankName'),
            ':TransferType' => $request->input('trsfType', 1),
            ':strOrderID'   => $orderID
        ];
        $list    = TreasureDataProvider::creatBankPayOrder($params);
        $data    = [
            'code' => $list->res,
            'msg'  => $list->customResult == null ? '' : $list->customResult,
            'data' => [
                'apiVersion' => 20200128,
                'valid'      => $list->res == 0 ? true : false
            ]
        ];
        return $data;
    }
}