<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 11:37
 */

namespace App\Http\Services\GameWeb;
use App\Http\Models\GameWeb\NativeWebDataProvider;
use App\Http\Models\GameWeb\PlatformDataProvider;
use App\Http\Services\BaseService;

class GetGameListService extends BaseService
{
    /**
     * 获取游戏列表
     * @return mixed
     */
    public static function getGameList()
    {
        // 获取大厅版本配置
        $lobbyConfig = NativeWebDataProvider::getConfigInfo('MobilePlatformVersion');

        // 获取游戏列表
        $gameList = PlatformDataProvider::getGameList();

        $data = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion'  => 20200118,
            'valid'       => true,
            'downloadUrl' => $lobbyConfig->Field1,
            'reversion'   => $lobbyConfig->Field2,
            'resVersion'  => $lobbyConfig->Field3,
            'iosUrl'      => $lobbyConfig->Field4,
            'description' => $lobbyConfig->Field8,
            'data'        => $gameList
        ];
        // dd($lobbyConfig);
        return $data;
    }
}