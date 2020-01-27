<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/27
 * Time: 11:19
 */

namespace App\Http\Services\GameWeb;

use App\Http\Models\GameWeb\RecordDataProvider;
use App\Http\Services\BaseService;

class rewardrBill extends BaseService
{
    /**
     *获取领奖列表记录
     */
    public static function rewardrBill($request) {
        $userId = $request->input('userid');
        $pageIndex = $request->input('pageIndex', 1);
        $list = RecordDataProvider::getRewardDrawalBill($userId, $pageIndex);
        $data         = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion' => '20200123',
            'valid'      => true,
            'list'       => $list->items(),
            'page'  => $list->lastPage(),
            'index'      => $list->currentPage()
        ];
        return $data;
    }
}