<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/18
 * Time: 14:38
 */

namespace App\Http\Services;


class GameService extends BaseService
{
    /**
     * PHP魔术方法，对象中调用一个不可访问方法时，__call() 会被调用。
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        // 注意: $name 的值区分大小写
        $data = self::getJsonFails();
        $data['msg'] = 'Not found this method: '.$name.'!';
        return $data;
    }

    /**
     * @param $serviceName
     * @return mixed
     */
    public static function GameWeb($serviceName)
    {
        $className = 'App\\Http\\Services\\GameWeb\\' . $serviceName;
        return new $className;
    }

    /**
     * 获取玩家信息
     * @param $request
     * @return array
     */
    public function GetUserInfo($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }


    /**
     * 分享玩家彩金
     * @return array
     */
    public function getShareReward()
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}();
    }


    /**
     * 获取VIP信息
     * @param $request
     * @return array
     */
    public function getVipInfo($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }


    /**
     * 启动转盘
     * @param $request
     * @return array|mixed
     */
    public function startTurnTable($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }


    /**
     * 实时滚动数据
     * @return array
     */
    public function getTurnTableMsg()
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}();
    }


    /**
     * 自己的得奖记录
     * @param $request
     * @return mixed
     */
    public function getTurnTableRecord($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }


    /**
     * 获得排名数据
     * @param $request
     * @return mixed
     */
    public function getRankingData($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }


    /**
     * 获取大厅版本配置
     * @return mixed
     */
    public function getGameList()
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}();
    }


    /**
     * 支付记录
     * @param $request
     * @return mixed
     */
    public function payRecord($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }

    /**
     * 支付列表
     * @return mixed
     */
    public function payList()
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getUserWealth($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getMobileLoginLater($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }

    /**
     * 获取邮件列表
     * @param $request
     * @return mixed
     */
    public function getMailList($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }

    /**
     * 获取代理信息
     * @param $request
     * @return mixed
     */
    public function getAgentInfo($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }

    /**
     * 推广明细
     * @param $request
     * @return mixed
     */
    public function rewardRecord($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }

    /**
     * 推广排行
     * @param $request
     * @return mixed
     */
    public function agentRank($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }

    public function imgPay($request)
    {
        $className = __FUNCTION__;
        return self::GameWeb($className)->{$className}($request);
    }
}