<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/20
 * Time: 11:28
 */

namespace App\Http\Models\GameWeb;

use Illuminate\Support\Facades\DB;


class PlatformDataProvider
{
    private static $db = 'WHQJPlatformDB';

    public function __construct()
    {
        //self::$db = '22222';
    }

    public static function GetTurntableConfigs()
    {
        $res = DB::connection(self::$db)->table('TurntableConfig')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->orderBy('id')
            ->get();
        return $res;
    }

    public static function GetVipConfig()
    {
        $res = DB::connection(self::$db)->table('VipConfig')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->get();
        return $res;
    }


    /**
     * @param $userId
     * @param $index
     * @param $size
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getMailList($userId, $index, $size)
    {
        $list = DB::connection(self::$db)->table('UserMail')
            ->select('OrderAmount AS Amount', 'OrderStatus AS OrderStates', 'ApplyDate AS PayTime')
            ->selectRaw('type =3')
            ->where('UserID', '=', $userId)
            ->where('MState', '<', 3)
            ->orderByDesc('MState')
            ->orderByDesc('SendTime')
            ->paginate($size, ['*'], 'index', $index);
        return $list;
    }

    public static function setMailState($userId, $mid, $state)
    {
        $params = [
            ':dwUserID' => $userId,
            ':mId'      => $mid,
            ':state'    => $state,
        ];
        $res    = DB::connection(self::$db)->select("DECLARE @customResult NVARCHAR(127), @res int;
        exec @res = NET_PW_DealMail @dwUserID=:dwUserID, @mId=:mId, @state=:state, @strErrorDescribe=@customResult OUTPUT; select @res as code, @customResult as msg", $params);
      //dd($res);
        return current($res);
    }
}