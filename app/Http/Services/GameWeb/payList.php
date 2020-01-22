<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 18:47
 */

namespace App\Http\Services\GameWeb;


class payList
{
    /**
     *
     */
    public static function payList() {

        //线上充值
        $data = [
            'code' => 0,
            'msg'  => '',
            'data' => [
                'apiVersion' => 20200118,
                'valid'      => true
            ]
        ];
        for ($payType = 1; $payType <= 3; ++$payType) {
            $list = TreasureDataProvider::getOnLinePayList($payType);
            if (count($list) == 0) continue;
            $tmp = [];
            foreach ($list as $key => $value) {
                array_push($tmp, [
                    'id'     => $value->ID,
                    'PayType'    => $value->PayType,
                    'PayName' => $value->PayName,
                    'ShoutCut' => $value->ShoutCut,
                    'PresentScore' => $value->PresentScore,
                    'ChanelID' => $value->ChanelID,
                    'MaxAmount' => $value->MaxAmount,
                    'MinAmount' => $value->MinAmount,
                ]);
            }

            $data['data']['list1_'.$payType] = $tmp;
        }

        $list2 = TreasureDataProvider::getBankPayList();
        if (count($list2) != 0) {
            $data['data']['list2'] = $list2;
        }

        $list3 = TreasureDataProvider::getImgPayList();
        if (count($list3) != 0) {
            $data['data']['list3'] = $list3;
        }

        $list4 = TreasureDataProvider::getOnLineWeChatList();
        if (count($list4) != 0) {
            $data['data']['list4'] = $list4;
        }
        return $data;
    }
}