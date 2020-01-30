<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 11:35
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\NativeWebDataProvider;

class GetRankingDataService
{
    //获得排名数据
    public static function getRankingData($request)
    {
        $userId = $request->all()['userid'] ?? 0;
        $typeId = $request->all()['typeid'];

        try {
            $arr  = [1, 2, 3, 4, 5, 6];
            $data = NativeWebDataProvider::GetDayRankingData($userId, $arr[$typeId - 1]);

        } catch (\Exception $e) {
            $data        = config('NetFox.jsonMSG');
            $data['msg'] .= 'typeId 参数不合法！';
        }
        return $data;
    }
}