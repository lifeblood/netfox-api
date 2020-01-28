<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 15:16
 */

namespace App\Http\Services\GameWeb;


use App\Http\Models\GameWeb\PlatformDataProvider;
use App\Http\Models\GameWeb\TreasureDataProvider;
use App\Http\Services\BaseService;

class getTurnTables extends BaseService
{
    public static function getTurnTables($request) {
        $userId   = $request->input('userid');
        $list     = PlatformDataProvider::GetTurntableConfigs();
        $sList = [];
        $mgList = [];
        array_push($sList, $list[0], $list[5], $list[10]);
        array_push($mgList, $list[4], $list[9], $list[14]);

        $validBet = TreasureDataProvider::GetValidBetByUid($userId);

        $data = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion' => '20200123',
            'valid'      => true,
            'list'        => $sList,
            'icoList'        => $mgList,
            'todayValibet'        => $validBet->TodayValiBet,
            'GrandScore'        => $validBet->GrandScore,
        ];
        return $data;
    }
}