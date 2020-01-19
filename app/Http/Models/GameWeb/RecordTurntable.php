<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/19
 * Time: 18:34
 */

namespace App\Http\Models\GameWeb;
use Illuminate\Database\Eloquent\Model;

define('DB', env('DB_DATABASE_Record'));


class RecordTurntable extends Model
{
    protected $connection = DB;
    protected $table = 'RecordTurntable';
    protected $casts = [
        'Reward' => 'integer',
        'Score' => 'integer',
        'Opentime' => 'datetime:Y-m-d H:i:s',
    ];
}