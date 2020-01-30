<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 13:18
 */

namespace App\Http\Services\GameWeb;

use App\Http\Models\GameWeb\RecordDataProvider;
use App\Http\Services\BaseService;
use Illuminate\Support\Str;

class RecordDiamondsTradeService extends BaseService
{
    /**
     * @param $request
     * @return mixed
     */
    public static function recordDiamondsTrade($request) {
        $userId         = $request->input('userid');
        $pageIndex      = $request->input('page', 1);
        $pageSize       = $request->input('size', 10);
        $goldStreamList = RecordDataProvider::getDiamondStreamList($userId, $pageIndex, $pageSize);
        $list           = [];
        foreach ($goldStreamList->items() as $key => $item) {
            $list[$key]['SerialNumber'] = $item->SerialNumber;
            $list[$key]['SerialTime']   = Str::substr($item->CollectDate, 0, 19);
            $list[$key]['BeforeDiamond']   = $item->CurDiamond;
            $list[$key]['ChangeDiamond']   = $item->ChangeDiamond;
            $list[$key]['AfterDiamond']    = $item->CurDiamond + $item->ChangeDiamond;
            $list[$key]['Type'] = config('NetFox.operationName.' . $item->TypeID) ?? '未知类型';
        }
        $data         = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion' => '20200123',
            'valid'      => true,
            'list'       => $list
        ];
        return $data;
    }
}