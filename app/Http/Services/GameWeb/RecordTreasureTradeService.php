<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 10:34
 */

namespace App\Http\Services\GameWeb;


use App\Enums\RecordTreasureType;
use App\Http\Models\GameWeb\RecordDataProvider;
use App\Http\Services\BaseService;
use Illuminate\Support\Str;

class RecordTreasureTradeService extends BaseService
{
    /**
     * 金币流水记录
     * @param $request
     * @return mixed
     */
    public static function recordTreasureTrade($request)
    {
        $userId         = $request->input('userid');
        $pageIndex      = $request->input('page', 1);
        $pageSize       = $request->input('size', 10);
        $goldStreamList = RecordDataProvider::getGoldStreamList($userId, $pageIndex, $pageSize);
        $list           = [];
        foreach ($goldStreamList->items() as $key => $item) {
            $list[$key]['SerialNumber'] = $item->SerialNumber;
            $list[$key]['SerialTime']   = Str::substr($item->CollectDate, 0, 19);
            $list[$key]['BeforeGold']   = $item->CurScore + $item->CurInsureScore;
            $list[$key]['ChangeGold']   = $item->ChangeScore;
            $list[$key]['AfterGold']    = $item->CurScore + $item->CurInsureScore +
                //银行存取操作不需要加上变化值
                ($item->TypeID == RecordTreasureType::SAVE_IN_BANK ||
                $item->TypeID == RecordTreasureType::TAKE_OUT_BANK ? 0 : $item->ChangeScore);
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

