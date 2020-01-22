<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/22
 * Time: 10:32
 */

namespace App\Http\Services;


class Service
{

    /**
     * @param $serviceName
     * @return mixed
     */
    public static function GameWeb($serviceName)
    {
        $className = 'App\\Http\\Services\\GameWeb\\' . $serviceName;
        return new $className;
    }
}