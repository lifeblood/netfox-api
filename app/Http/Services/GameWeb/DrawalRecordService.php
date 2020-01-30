<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 16:02
 */

namespace App\Http\Services\GameWeb;


use App\Http\Models\GameWeb\TreasureDataProvider;
use App\Http\Services\BaseService;

class DrawalRecordService extends BaseService
{

    /**
     * 提款记录
     * @param $request
     * @return mixed
     */
    public static function drawalRecord($request)
    {
        $userId       = $request->input('userid');
        $index        = $request->input('index', 1);
        $type         = $request->input('type', 0);
        $list         = TreasureDataProvider::getDrawalRecord($userId, $type, $index);
        $data         = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion' => '20200123',
            'valid'      => true,
            'index'      => $list->currentPage(),
            'pageCount'  => $list->lastPage(),
            'list'       => $list->items()
        ];
        return $data;
    }

}