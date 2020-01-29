<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/19
 * Time: 16:00
 */

namespace App\Http\Models\GameWeb;
use App\Http\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AccountsDataProvider extends BaseModel
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
     * @return array
     */
    public static function getMobileLoginLaterData($userId) {
        $sql = "exec NET_PW_GetMobileLoginLater :dwUserID";
        $params = [':dwUserID' => $userId];
        $data = parent::getMultiResultSet(self::$db, $sql, $params);
        //dd($data);
        return $data;
    }

    /**
     * 获取系统配置信息
     * @param $key
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getSystemStatusInfo($key) {
        $res = DB::connection(self::$db)->table('SystemStatusInfo')
            ->lock('WITH(NOLOCK)')
            ->select('StatusValue')
            ->where('StatusName','=',$key)
            ->first();
        return $res;
    }

    /**
     * 验证是否在规定时间内重复发送
     * false: 没有重复
     * true: 重复
     * @param $mobile
     * @param $minutes
     * @return bool
     */
    public static function validSendOnTime($mobile, $minutes) {
        $res = DB::connection(self::$db)->table('CheckCode')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->where('PhoneNum','=', $mobile)
            ->whereRaw('GETDATE() < DATEADD(MINUTE,' . $minutes . ',CollectTime)')
            ->orderByDesc('CollectTime')
            ->skip(0)->take(1)
            ->first();
        return $res == null;
    }


    public static function insertSMSInfo($mobile, $code) {
        //使用 transaction 方法时不需要手动回滚或提交：如果事务闭包中抛出异常，事务将会自动回滚；
        //如果闭包执行成功，事务将会自动提交：
        $res = DB::connection(self::$db)->transaction( function () use ($mobile, $code) {
            DB::connection(self::$db)->table('CheckCode')
                ->where('PhoneNum', '=', $mobile)->delete();


            DB::connection(self::$db)->table('CheckCode')->insert(
                ['PhoneNum'    => $mobile,
                 'CheckCode'   => $code,
                 'CollectTime' => DB::raw('getdate()'),
                ]
            );

            DB::connection(self::$db)->table('SMSLog')->insert(
                ['Mobile' => $mobile,
                 'date'   => DB::raw('getdate()'),
                ]
            );
         });
    }


    /**
     * 根据账号获取用户信息
     * @param $Accounts
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getAccountsInfoByAccounts($Accounts) {
        $res = DB::connection(self::$db)->table('AccountsInfo')
            ->lock('WITH(NOLOCK)')
            ->select('UserID')
            ->where('Accounts','=',$Accounts)
            ->first();
        return $res;
    }

    public static function getSMSLogCount($Mobile) {
        $dt = Carbon::now();
        $startOfDay = $dt->copy()->startOfDay(); //2017-05-15 00:00:00
        $endOfDay = $dt->copy()->endOfDay();  //2017-05-15 23:59:59
        $res = DB::connection(self::$db)->table('SMSLog')
            ->lock('WITH(NOLOCK)')
            ->selectRaw('isnull(count(id),0)')
            ->where('Mobile','=',$Mobile)
            ->where('date','>=',$startOfDay)
            ->where('date','<=',$endOfDay)
            ->first();
        return $res;
    }

    /**
     * 绑定支付宝
     * @param $userId
     * @param $type
     * @param $acc
     * @return mixed
     */
    public static function postBandingPayee($userId, $type, $acc) {
        $params = [
            ':dwUserID'  => $userId,
            ':Type'  => $type,
            ':Acc'  => $acc,
        ];
        $res    = DB::connection(self::$db)->select("DECLARE @customResult NVARCHAR(127),@res int;
        exec @res = NET_PW_BindPayee @dwUserID=:dwUserID, @Type=:Type, @Acc=:Acc, @strErrorDescribe=@customResult OUTPUT; select @res as code, @customResult as msg", $params);
       // dd($res);
        return current($res);
    }
}