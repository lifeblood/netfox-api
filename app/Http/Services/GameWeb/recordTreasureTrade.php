<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 10:34
 */

namespace App\Http\Services\GameWeb;


class recordTreasureTrade
{
    public static function recordTreasureTrade($request) {
        $userId = $request->input('userid');
        $pageIndex = $request->input('page', 1);
        $pageSize = $request->input('size', 10);

    }
}