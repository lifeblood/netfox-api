<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/27
 * Time: 10:43
 */

namespace App\Http\Services;


class GameWebService
{
    /**
     * PHP Patterns: Singleton ( 单例模式 )
     * 静态成员变量 保存全局实例
     */
    private static $instance;
    private static $classPath = 'App\\Http\\Services\\GameWeb\\';

    /**
     * 私有化默认构造方法，保证外界无法直接实例化
     * GameWebService constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param $serviceName
     * @return mixed
     */
    public static function getInstance($serviceName)
    {
        if (is_null(static::$instance)) {
            static::$instance = static::$classPath . $serviceName;
        }
        return static::$instance;
    }

    /**
     * 防止用户克隆实例
     */
    final public function __clone()
    {
    }

    /**
     * 防止私有化重建方法
     */
    final public function __wakeup()
    {
    }
}