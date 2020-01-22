<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/19
 * Time: 16:00
 */

namespace App\Http\Services\GameWeb;
use Illuminate\Support\Facades\DB;


class AccountsDataProvider
{
    private static $db = 'WHQJAccountsDB';

    /**
     * @param $userId
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function GetAccountsInfoByUserID($userId) {
        $res = DB::connection(self::$db)->table('AccountsInfo')
            ->lock('WITH(NOLOCK)')
            ->select('UserID','GameID','SpreaderID','NickName','PassPortID','Compellation','FaceID',
                'CustomID','RegisterOrigin','AgentID','RegisterIP','LastLogonIP','UnderWrite','PlaceName','UserUin',
                'AgentID','RegisterMobile')
            ->where('UserID','=',$userId)
            ->first();
        return $res;
    }


    /**
     * 随机获取用户信息
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getRandomAndroid() {
        $res = DB::connection(self::$db)->table('AccountsInfo')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->where('IsAndroid', '=', 1)
            ->orderByRaw('NEWID()')
            ->skip(0)->take(1)
            ->first();
        return $res;
    }
}