<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/18
 * Time: 14:38
 */

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Services\FacadeManager;
use App\Http\Services\GameWeb\AccountsDataProvider;
use App\Http\Services\GameWeb\RecordDataProvider;


class GameService
{
    protected $db = [
        'Accounts'  => 'WHQJAccountsDB',
        'Agent'     => 'WHQJAgentDB',
        'GameMatch' => 'WHQJGameMatchDB',
    ];

    public function factory($name, $request)
    {
        try {

            $funcName = config('NetFox.action.' . $name);
            return $this->$funcName($request);
        } catch (\Error $e) {
            $jsonMSG = config('NetFox.jsonMSG');
            $jsonMSG['msg'] = '抱歉， ' . $name . ' API 不存在!'.$e->getMessage();
            return $jsonMSG;
        }
    }

    //获取玩家信息

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

    // 启动转盘
    public function startTurnTable($request) {
        return FacadeManager::CreatTurnTable($request);

    }

    //实时滚动数据
    public function getTurnTableMsg() {
        return FacadeManager::CreatTurnTableDate();
    }

    //自己的得奖记录
    public function getTurnTableRecord($request)
    {
        $userId  = $request->all()['userid'];
        $index   = $request->all()['index'];
        $size    = $request->all()['size'];
        try {
            $records = RecordDataProvider::GetRecordTurntableByUserID($userId, $index, $size);
            $data = [
                'code'      => 0,
                'msg'       => '',
                'data'      => [
                    'apiVersion' => 20200118,
                    'valid'      => true,
                    'records'    => $records,
                ],
                'totalpage' => '1',
                'index'     => $index
            ];
        }catch (\Exception $e) {
            $data        = config('NetFox.jsonMSG');
            $data['msg'] .= $userId .'不是整数！';
        }
        return $data;
    }


    public function getMobileGameAndVersion($request)
    {
//        dd($request->all());
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