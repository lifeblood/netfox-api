<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 13:20
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\TreasureDataProvider;
use Illuminate\Support\Str;


class payRecord
{
    public static function payRecord($request)
    {
        $userId = $request->all()['userid'];
        $index  = $request->all()['index'] ?? 1;

        $res = TreasureDataProvider::getPayRecord($userId, $index);

        $list = [];
        foreach ($res->items() as $key => $data) {
            array_push($list, [
                'PayTime'     => Str::substr($data->PayTime, 0, 19),
                'PayMoney'    => $data->Amount,
                'OrderStatus' => $data->OrderStates,
            ]);
        }

        $data = [
            'code' => 0,
            'msg'  => '',
            'data' => [
                'apiVersion' => 20200118,
                'valid'      => true,
                'index'      => $res->currentPage(),
                'pageCount'  => $res->lastPage(),
                'list'       => $list,
            ]
        ];
        return $data;
    }
}