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

    public static function GetAccountsInfoByUserID($userid) {
        $db = env('DB_DATABASE_Accounts');
        $res = DB::connection($db)->table('AccountsInfo')
            ->lock('WITH(NOLOCK)')
            ->select('UserID','GameID','SpreaderID','NickName','PassPortID','Compellation','FaceID',
                'CustomID','RegisterOrigin','AgentID','RegisterIP','LastLogonIP','UnderWrite','PlaceName','UserUin',
                'AgentID','RegisterMobile')
            ->where('UserID','=',$userid)
            ->first();
        return $res;
    }
}