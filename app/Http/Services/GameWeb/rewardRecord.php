<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/23
 * Time: 15:18
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\AccountsDataProvider;

class rewardRecord
{

    public static function rewardRecord($request) {
        $userId = $request->all()['userid'];
        $index = $request->all()['index'] ?? 1;
        $list = AccountsDataProvider::getRewardRecord($userId, $index);
        $data = [
            'code' => 0,
            'msg'  => '',
            'data' => [
                'apiVersion' => 20200118,
                'valid'      => true,
                'list'       => $list->items(),
                'Count'  => $list->lastPage(),
                'pageIndex'      => $list->currentPage()
            ]
        ];
        return $data;
    }
}