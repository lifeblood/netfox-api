<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/29
 * Time: 17:51
 */

namespace App\Http\Services\GameWeb;


use App\Http\Models\GameWeb\NativeWebDataProvider;
use App\Http\Services\BaseService;
use Illuminate\Support\Str;


class GetMobileLoginDataService extends BaseService
{
    private static $pattern = ['http://','https://'];

    /**
     * 获取手机端配置
     * @param array $table
     * @return array
     */
    private static function getMobileSystemConfig(array $table)
    {
        $row           = $table;
        $statusNameMap = [
            'GrantScoreCount'          => 'RegistGrant',
            'JJOpenMobileMall'         => 'IsOpenMall',
            'JJPayBindSpread'          => 'IsPayBindSpread',
            'JJBindSpreadPresent'      => 'BindSpreadPresent',
            'JJRankingListType'        => 'RankingListType',
            'JJPayChannel'             => 'PayChannel',
            'JJDiamondBuyProp'         => 'DiamondBuyPropCount',
            'JJRealNameAuthentPresent' => 'RealNameAuthentPresent',
            'JJEffectiveFriendGame'    => 'EffectiveFriendGame',
            'IOSNotStorePaySwitch'     => 'IOSNotStorePaySwitch',
            'JJGoldBuyProp'            => 'GoldBuyPropCount',
            'EnjoinInsure'             => 'EnjoinInsure',
            'TransferStauts'           => 'TransferStauts',
            'MobileBattleRecordMask'   => 'MobileBattleRecordMask',
            'OpenGameSignIn'           => 'IsOpenGameSignIn',
            'IsRedemptionCenter'       => 'IsOpenRedemptionCenter',
        ];
        $data          = [];

        foreach ($row as $key => $item) {
            if (!array_key_exists($item['StatusName'], $statusNameMap))
                continue;
            array_push($data, [
                $statusNameMap[$item['StatusName']] => $item['StatusValue']
            ]);
        }
        return $data;
    }

    private static function getGroupConfig(array $table)
    {
        $row           = $table;
        $optionNameMap = [
            'MaxMemberCount'         => 'MaxMemberCount',
            'MaxCreateGroupCount'    => 'MaxCreateGroupCount',
            'CreateGroupTakeIngot'   => 'CreateGroupTakeIngot',
            'CreateGroupDeductIngot' => 'CreateGroupDeductIngot',
            'MaxJoinGroupCount'      => 'MaxJoinGroupCount',
            'GroupPayType'           => 'GroupPayType',
            'GroupPayTypeChange'     => 'GroupPayTypeChange',
            'GroupRoomType'          => 'GroupRoomType'
        ];
        $data          = [];

        foreach ($row as $key => $item) {
            if (!array_key_exists($item['OptionName'], $optionNameMap))
                continue;
            array_push($data, [
                $optionNameMap[$item['OptionName']] => $item['OptionValue']
            ]);
        }
        return $data;
    }

    //获取手机端登录数据
    public static function getMobileLoginData($request)
    {
        $userId          = $request->input('userid');
        $device          = $request->input('device');
        $PlatformType    = $request->input('PlatformType', 1);
        $webConfig       = NativeWebDataProvider::getConfigInfo('WebSiteConfig');  //网站站点配置
        $MobileConfig    = NativeWebDataProvider::getConfigInfo('GetMobileConfig');  //网站站点配置
        $imageServerHost = $webConfig->Field2;

        //获取登录数据
        $ds = NativeWebDataProvider::getMobileLoginInfo();
        //获取系统配置信息
        $config      = self::getMobileSystemConfig($ds[0]);
        $groupConfig = self::getGroupConfig($ds[9]);

        //获取客服界面配置
        $mcs = current($ds[1]);
        //获取系统公告配置
        $noticeList = $ds[2];
        foreach ($noticeList as $key => $item) {
            $noticeList[$key]['MoblieContent'] = $imageServerHost . $item['MoblieContent'];
        }

        //获取手机固定位广告图
        $plate = $ds[3];
        foreach ($plate as $key => $item) {
            $plate[$key]['ResourceURL'] = Str::is(self::$pattern, $item['ResourceURL'])
                ? $item['ResourceURL'] : $imageServerHost . $item['ResourceURL'];
        }

        //获取手机弹出广告图
        $alert = $device == 'h5' ? $ds[3] : $ds[4];
        foreach ($alert as $key => $item) {
            $alert[$key]['ResourceURL'] = Str::is(self::$pattern, $item['ResourceURL'])
                ? $item['ResourceURL'] : $imageServerHost . $item['ResourceURL'];
        }

        //获取手机活动广告
        $activity = $ds[7];
        foreach ($activity as $key => $item) {
            $activity[$key]['ResourceURL'] = Str::is(self::$pattern, $item['ResourceURL'])
                ? $item['ResourceURL'] : $imageServerHost . $item['ResourceURL'];
        }

        $data         = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion'      => '20200129',
            'valid'           => true,
            'systemConfig'    => $config,
            'Groupconfig'     => $groupConfig,
            'customerService' => $mcs,
            'systemNotice'    => $noticeList,
            'adsList'         => $plate,
            'adsAlertList'    => $alert,
            'activityList'    => $activity,
            'imageServerHost' => $imageServerHost,
            'MobileConfig'    => $MobileConfig,
        ];
        return $data;
    }
}