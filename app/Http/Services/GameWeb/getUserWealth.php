<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/23
 * Time: 10:26
 */

namespace App\Http\Services\GameWeb;
use App\Http\Services\BaseService;
use App\Http\Models\GameWeb\TreasureDataProvider;

class getUserWealth extends BaseService
{
    public static function getUserWealth($request)
    {
        $userId = $request->all()['userid'];

        $res = TreasureDataProvider::getUserWealth($userId);
        $data = self::getJsonSuccess();
        $res = empty(current($res)) ? null : current($res);

        $data['data'] = [
            'apiVersion' => '20200123',
            'valid' => true,
            'diamond' => isset($res) ? $res->Diamond : 0,
            'score' => isset($res) ? $res->Score : 0,
            'insure' => isset($res) ? $res->InsureScore : 0,
            'awardticket' => isset($res) ? $res->AwardTicket : 0,
        ];
        return $data;
    }
}