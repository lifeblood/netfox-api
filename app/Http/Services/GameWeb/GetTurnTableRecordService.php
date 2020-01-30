<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 11:33
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\RecordDataProvider;

class GetTurnTableRecordService
{

    /**
     * 自己的得奖记录
     * @param $request
     * @return array|mixed
     */
    public static function getTurnTableRecord($request) {
        $userId  = $request->all()['userid'];
        $index   = $request->all()['index'] ?? 0;
        $size    = $request->all()['size'] ?? 10;
        try {
            $records = RecordDataProvider::GetRecordTurntableByUserID($userId, $index, $size);
            $data = [
                'code'      => 0,
                'msg'       => '',
                'data'      => [
                    'apiVersion' => 20200118,
                    'valid'      => true,
                    'records'    => $records,
                ],
                'totalpage' => '1',
                'index'     => $index
            ];
        }catch (\Exception $e) {
            $data        = config('NetFox.jsonMSG');
            $data['msg'] .= $userId .'不是整数！';
        }
        return $data;
    }
}