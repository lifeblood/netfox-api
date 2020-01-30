<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 11:22
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\AccountsDataProvider;
use App\Http\Services\BaseService;

class GetUserInfoService extends BaseService
{
    /**
     * 获取玩家信息
     * @param $request
     * @return array
     */
    public static function GetUserInfo($request)
    {
        $userId   = $request->all()['userid'];
        $userInfo = AccountsDataProvider::GetAccountsInfoByUserID($userId);
        $data = self::getJsonSuccess();
        $data['data']     = [
            'apiVersion'  => '20200118',
            'valid'       => true,
            'UserID'      => $userInfo->UserID,
            'GameID'      => $userInfo->GameID,
            'CustomID'    => $userInfo->CustomID,
            'NickName'    => $userInfo->NickName,
            'UnderWrite'  => $userInfo->UnderWrite,
            'LastLogonIP' => $userInfo->LastLogonIP,
            'PlaceName'   => $userInfo->PlaceName
        ];
        return $data;
    }
}