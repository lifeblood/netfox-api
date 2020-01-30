<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/23
 * Time: 15:03
 */

namespace App\Http\Services\GameWeb;

use App\Http\Models\GameWeb\TreasureDataProvider;
use App\Http\Services\BaseService;

class GetAgentInfoService extends BaseService
{
    public static function getAgentInfo($request)
    {
        $userId = $request->input('userid');
        $res    = TreasureDataProvider::getAgentInfo($userId);
        $data   = self::getJsonSuccess();

        $data['data'] = [
            'apiVersion'      => '20200123',
            'valid'           => true,
            'Allperson'       => isset($res) ? $res->Allperson : 0,
            'Immediateperson' => isset($res) ? $res->Immediateperson : 0,
            'ImmediateMoney'  => isset($res) ? $res->ImmediateMoney : 0,
            'OtherMoney'      => isset($res) ? $res->OtherMoney : 0,
            'CurrReward'      => isset($res) ? $res->CurrReward : 0,
            'HisMoney'        => isset($res) ? $res->HisMoney : 0,
        ];
        return $data;
    }
}