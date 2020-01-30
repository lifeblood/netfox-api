<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 17:04
 */

namespace App\Http\Services\GameWeb;


use App\Enums\ApiCode;
use App\Http\Models\GameWeb\NativeWebDataProvider;
use App\Http\Models\GameWeb\TreasureDataProvider;
use App\Http\Services\BaseService;
use App\Http\Services\GameUtils;

class WithDrawalService extends BaseService
{
    private static $multiple = 1000;

    /**
     * 提现
     * @param $request
     * @return array|mixed
     */
    public static function withDrawal($request) {
        $userId = $request->input('userid');
        $drawalType = $request->input('drawalType', 1);
        $amount = $request->input('amount', 1000);

        /**判断玩家金币*/
        $cfg = NativeWebDataProvider::getConfigInfo('DrawalConfig');
        $p = $cfg->Field1;
        $min = $cfg->Field2 * self::$multiple;
        $max = $cfg->Field3 * self::$multiple;

        if ($amount < $min || $amount > $max) {
            $data = self::getJsonFails();
            $data['code'] = ApiCode::LogicErrorCode;
            $data['code'] = '提现金额必须在'.$min.'-'.$max.'之间';
            return $data;
        }

        /**判断打码量*/
        $validBet = TreasureDataProvider::GetValidBetByUid($userId);
        if ($validBet->CurrentValidBet < $validBet->TargetBet) {
            $data = self::getJsonFails();
            $data['code'] = ApiCode::LogicErrorCode;
            $data['code'] = '打码量不足，目标打码量 '. $validBet->TargetBet / self::$multiple . '，当前打码量'. $validBet->CurrentValidBet / self::$multiple;
            return $data;
        }

        /**创建订单*/
        $cost = $amount * $p / 100;
        $order = [
            ':OrderID' => GameUtils::getOrderIDByPrefix('draw'),
            ':Amount' => $amount,
            ':OrderCost' => $cost,
            ':IP' => $request->getClientIp(),
            ':UserID' => $userId,
            ':drawalType' => $drawalType,
        ];
        $list = TreasureDataProvider::createDrawalOrder($order);
        $data = [
            'code' => $list->res,
            'msg' =>$list->customResult,
            'data' => [
                'apiVersion' => 20200128,
                'valid' => $list->res == 0 ? true : false
            ]
        ];
        return $data;
    }
}