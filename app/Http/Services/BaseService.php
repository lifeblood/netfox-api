<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 10:32
 */

namespace App\Http\Services;


class BaseService
{

    /**
     * @return mixed
     */
    public static function getJsonSuccess() {
        return config('NetFox.jsonSuccess');
    }

    public static function getJsonFails() {
        return config('NetFox.jsonFails');
    }
}