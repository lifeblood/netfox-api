<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/29
 * Time: 13:36
 */

namespace App\Http\Models;
use Illuminate\Support\Facades\DB;


class BaseModel
{
    /**
     * 获取事务等多个SQL RESULT SETS
     * @param $conn
     * @param $sql
     * @param $params
     * @return array
     */
    public static function getMultiResultSet($conn, $sql, $params = null) {
        $results = [];
        $pdo = DB::connection($conn)->getPdo();
        $result = $pdo->prepare($sql);
        $result->execute($params);
        do {
            $resultSet = [];
            foreach ($result->fetchall(\PDO::FETCH_ASSOC) as $res) {
                array_push($resultSet, $res);
            }
            array_push($results, $resultSet);
        } while ($result->nextRowset());

        return $results;
    }
}