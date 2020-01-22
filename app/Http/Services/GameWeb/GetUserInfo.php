<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 11:22
 */

namespace App\Http\Services\GameWeb;


class GetUserInfo
{
    /**
     * 获取玩家信息
     * @param $request
     * @return array
     */
    public function GetUserInfo($request)
    {
        $userId   = $request->all()['userid'];
        $userInfo = AccountsDataProvider::GetAccountsInfoByUserID($userId);
        $data     = [
            'code'        => '0',
            'msg'         => '',
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