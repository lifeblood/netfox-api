<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 11:17
 */

namespace App\Http\Services\GameWeb;


class getShareReward
{
    public static function getShareReward() {
        return NativeWebDataProvider::GetShareRewardData();
    }
}