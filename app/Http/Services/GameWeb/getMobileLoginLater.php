<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/23
 * Time: 12:16
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\AccountsDataProvider;

class getMobileLoginLater
{
    public static function getMobileLoginLater($request) {
        $userId = $request->all()['userid'];
        //获取登录成功后数据
        $ds = AccountsDataProvider::getMobileLoginLaterData($userId);
    }
}