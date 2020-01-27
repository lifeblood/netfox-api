<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/19
 * Time: 16:00
 */

namespace App\Http\Models\GameWeb;
use Illuminate\Support\Facades\DB;


class AccountsDataProvider
{
    private static $db = 'WHQJAccountsDB';
    private static $pageLimit = 6;

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

    public static function getRewardRecord($userId, $index) {
        $res = DB::table(self::$db.'.dbo.AccountsInfo as a')
            ->join('WHQJTreasureDB.dbo.AgentInfo as r', 'a.UserID', '=', 'r.UserID')
            ->select('a.GameID', 'a.NickName', 'r.BeggarNumber', 'r.AllReward','r.Reward','r.BackMoney')
            ->where('r.ParentID','=', $userId)
            ->paginate(self::$pageLimit, ['*'], 'index', $index);
        return $res;
    }


    /**
     * 获取登录成功后数据
     * @param $userId
     */
    public static function getMobileLoginLaterData($userId) {
        $params = [':dwUserID' => $userId];
        $data = [];
        try {
            $data = DB::connection(self::$db)->select("exec NET_PW_GetMobileLoginLater :dwUserID", $params);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 'IMSSP') {   //SQLSTATE[IMSSP]: The active result for the query contains no fields.

            }
        }
        dd($data);

    }
}