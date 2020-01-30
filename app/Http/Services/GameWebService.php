<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/27
 * Time: 10:43
 */

namespace App\Http\Services;
use Illuminate\Support\Facades\Log;

class GameWebService
{
    /**
     * PHP Patterns: Singleton ( 单例模式 )
     * 静态成员变量 保存全局实例
     */
    private static $_instance;
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
        //不能用 is_null 判断，会导致phpunit不识别单例
        if (!(self::$_instance instanceof self)) {
            static::$_instance = static::$classPath . $serviceName .'Service';
        }

        //Log::error('getInstance: ' . static::$_instance);

        return static::$_instance;
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