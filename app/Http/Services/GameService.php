<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/18
 * Time: 14:38
 */

namespace App\Http\Services;


class GameService extends Service
{

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
}