<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/20
 * Time: 11:28
 */

namespace App\Http\Services\GameWeb;
use Illuminate\Support\Facades\DB;


define('DB', env('DB_DATABASE_Platform'));

class PlatformDataProvider
{
    public function __construct()
    {
        //self::$db = '22222';
    }
    public static function GetTurntableConfigs() {
        $res = DB::connection(DB)->table('TurntableConfig')
            ->lock('WITH(NOLOCK)')
            ->select('*')
            ->orderBy('id')
            ->get();
        return $res;
    }
}