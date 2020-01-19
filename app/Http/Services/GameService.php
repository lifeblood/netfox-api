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
    protected $db = [
        'Accounts' => 'WHQJAccountsDB',
        'Agent' => 'WHQJAgentDB',
        'GameMatch' => 'WHQJGameMatchDB',
    ];

    public function factory($name, $request) {
        try {
            $funcName = config('NetFox.action.'.$name);
            return $this->$funcName($request);
        } catch(\Error $e) {
            $this->jsonMSG['msg'] = '抱歉， '. $name .' API 不存在!';
            return $this->jsonMSG;
        }
    }

    public function getMobileGameAndVersion($request) {
//        dd($request->all());
        // 获取大厅版本配置
        $db = env('DB_DATABASE_NativeWeb');
        $lobbyConfig = DB::connection($db)->table('ConfigInfo')
            ->select('Field1','Field2','Field3','Field4')
            ->where('ConfigKey','=','MobilePlatformVersion')
            ->first();

        // 获取游戏列表
        $db = env('DB_DATABASE_Platform');
        $gameList = DB::connection($db)->table('MobileKindItem')
            ->select('*')
            ->where('Nullity','=','0')
            ->orderBy('SortID','ASC')
            ->orderBy('KindID','DESC')
            ->get();

        $data = [
            'code' => '0',
            'msg' => '',
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