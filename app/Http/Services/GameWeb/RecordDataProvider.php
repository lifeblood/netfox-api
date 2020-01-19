<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/19
 * Time: 17:33
 */

namespace App\Http\Services\GameWeb;

use Illuminate\Support\Facades\DB;
use App\Http\Models\GameWeb\RecordTurntable;

class RecordDataProvider
{
    private static $db;

    public function __construct()
    {
        self::$db = env('DB_DATABASE_Record');
    }

    public static function GetRecordTurntableByUserID($userid, $index, $size)
    {
        $size = '10';
        $res = RecordTurntable::where('UserID', '=', $userid)
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
}