<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/23
 * Time: 15:18
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\AccountsDataProvider;
use App\Http\Services\BaseService;

class RewardRecordService extends BaseService
{

    /**
     * 查下级/推广明细
     * @param $request
     * @return array
     */
    public static function rewardRecord($request): array {
        $userId = $request->all()['userid'];
        $index = $request->all()['index'] ?? 1;
        $list = AccountsDataProvider::getRewardRecord($userId, $index);
        $data = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion' => 20200118,
            'valid'      => true,
            'list'       => $list->items(),
            'Count'  => $list->lastPage(),
            'pageIndex'      => $list->currentPage()
        ];
        return $data;
    }
}