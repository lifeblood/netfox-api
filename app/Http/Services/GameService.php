<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/18
 * Time: 14:38
 */

namespace App\Http\Services;
use Illuminate\Support\Facades\DB;


class GameService
{
    public function getMobileGameAndVersion() {
        // 获取大厅版本配置
        $lobbyConfig = DB::connection('WHQJNativeWebDB')->table('ConfigInfo')
            ->select('Field1','Field2','Field3','Field4')
            ->where('ConfigKey','=','MobilePlatformVersion')
            ->first();

        // 获取游戏列表
        $gameList = DB::connection('WHQJPlatformDB')->table('MobileKindItem')
            ->select('*')
            ->where('Nullity','=','0')
            ->orderBy('SortID','ASC')
            ->orderBy('KindID','DESC')
            ->get();

        $data = [
            'apiVersion' => '20200118',
            'valid' => true,
            'downloadUrl' => $lobbyConfig->Field1,
            'reversion' => $lobbyConfig->Field2,
            'resVersion' => $lobbyConfig->Field3,
            'iosUrl' => $lobbyConfig->Field4,
            'gamelist' => $gameList
        ];
       // dd($lobbyConfig);
        return $data;
    }
}