<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 11:33
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\RecordDataProvider;

class getTurnTableRecord
{
    //自己的得奖记录
    public static function getTurnTableRecord($request) {
        $userId  = $request->all()['userid'];
        $index   = $request->all()['index'];
        $size    = $request->all()['size'];
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