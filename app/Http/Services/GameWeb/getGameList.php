<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 11:37
 */

namespace App\Http\Services\GameWeb;
use Illuminate\Support\Facades\DB;

class getGameList
{
    public static function getGameList()
    {
        // 获取大厅版本配置
        $db          = env('DB_DATABASE_NativeWeb');
        $lobbyConfig = DB::connection($db)->table('ConfigInfo')
            ->select('Field1', 'Field2', 'Field3', 'Field4')
            ->where('ConfigKey', '=', 'MobilePlatformVersion')
            ->first();

        // 获取游戏列表
        $db       = env('DB_DATABASE_Platform');
        $gameList = DB::connection($db)->table('MobileKindItem')
            ->select('*')
            ->where('Nullity', '=', '0')
            ->orderBy('SortID', 'ASC')
            ->orderBy('KindID', 'DESC')
            ->get();

        $data = [
            'code'        => 0,
            'msg'         => '',
            'apiVersion'  => 20200118,
            'valid'       => true,
            'downloadUrl' => $lobbyConfig->Field1,
            'reversion'   => $lobbyConfig->Field2,
            'resVersion'  => $lobbyConfig->Field3,
            'iosUrl'      => $lobbyConfig->Field4,
            'data'        => $gameList
        ];
        // dd($lobbyConfig);
        return $data;
    }
}