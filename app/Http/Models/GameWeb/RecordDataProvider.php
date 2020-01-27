<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/19
 * Time: 17:33
 */

namespace App\Http\Models\GameWeb;


use Illuminate\Support\Facades\DB;
use App\Http\Models\GameWeb\RecordTurntable;


class RecordDataProvider
{
    private static $db = 'WHQJRecordDB';
    private static $pageLimit = 6;

    public function __construct()
    {
    }

    public static function GetRecordTurntableByUserID($userid, $index, $size)
    {
        $size = '10';
        $res = RecordTurntable::where('UserID', '=', $userid)
            ->lock('WITH(NOLOCK)')
            ->orderBy('Opentime', 'DESC')
            ->skip(0)->take($size)
            ->get();
       //dd($res);
        return $res;

        //        $res = DB::connection('WHQJRecordDB')->table('RecordTurntable')
//            //->lock('WITH(NOLOCK)')
//            ->select('*')
//            ->where('UserID', '=', $userid)
//            ->orderBy('Opentime', 'DESC')
//            ->skip(0)->take($size)
//            ->get();
    }

    public static function getRewardDrawalBill($userId, $pageIndex) {
        $res = DB::connection(self::$db)->table('RecordAgentReward')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->where('UserID','=',$userId)
            ->paginate(self::$pageLimit, ['*'], 'pageIndex', $pageIndex);;
        return $res;
    }
}