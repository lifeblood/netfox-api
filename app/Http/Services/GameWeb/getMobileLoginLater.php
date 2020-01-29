<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/23
 * Time: 12:16
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\AccountsDataProvider;
use App\Http\Models\GameWeb\NativeWebDataProvider;
use App\Http\Services\BaseService;
use App\Http\Services\GameUtils;

class getMobileLoginLater extends BaseService
{

    public static $multiple = 1000;

    public static function getMobileLoginLater($request) {
        $userId = $request->all()['userid'];

        //获取登录成功后数据
        $ds = AccountsDataProvider::getMobileLoginLaterData($userId);

        //获取提现
        $drawalConfig = NativeWebDataProvider::getConfigInfo('DrawalConfig');
        $drawalConfig->Field2 *= self::$multiple;
        $drawalConfig->Field3 *= self::$multiple;


        //获取推广链接（线上版本请将第三个参数设置成true，内部版本则为false）
        $shareLink = GameUtils::getSpreadLink($ds[0], false);
        $U3DShareLink = GameUtils::getU3DSpreadLink($ds[0]);

        //获取注册奖励
        $table = $ds[1];
        $grantDiamond = (count($table) > 0) ? current($table)['GrantDiamond'] : 0;
        $grantGold = (count($table) > 0) ? current($table)['grantGold'] : 0;

        //获取推广配置
        $spreadList = $ds[2];

        // 获取玩家的排行版信息 上210需注释
        $wealthRank = $ds[3];
        $winCountRank = $ds[4];

        //获取有效好友
        $table = $ds[5];
        $friendCount = (count($table) > 0) ? current($table)['Total'] : 0;

        //获取排行榜奖励配置 上210需注释
        $rankconfig = $ds[6];

        $data = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion' => '20200123',
            'valid'      => true,
            'drawalConfig'      => $drawalConfig,
            'sharelink'      => $shareLink,
            'U3DShareLink'      => $U3DShareLink,
            'hasGrant'      => $grantDiamond > 0 || $grantGold > 0,
            'grantDiamond'      => $grantDiamond,
            'grantGold'      => $grantGold,
            'friendcount'      => $friendCount,
            'spreadlist'      => $spreadList,
            'wealthrank'      => $wealthRank,
            'wincountrank'      => $winCountRank,
            'rankconfig'      => $rankconfig
            ];

        return $data;
    }
}