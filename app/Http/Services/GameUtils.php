<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/20
 * Time: 12:03
 */

namespace App\Http\Services;

use App\Http\Models\GameWeb\NativeWebDataProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;


class GameUtils
{
    private static $multiple = 1000;


    /**
     * 获取推广链接
     * @param array $table
     * @param bool $flag
     * @return string
     */
    public static function getSpreadLink(array $table, bool $flag): string
    {
        $shareLink = '';
        if (count($table) > 0) {
            $row       = current($table);
            $webConfig = NativeWebDataProvider::getConfigInfo('WebSiteConfig');  //网站站点配置
            $domain    = empty($webConfig->Field4) ? URL::to('/') : $webConfig->Field4;

            if ($flag) {
                if ($row['AgentID'] > 0) {
                    $shareLink = "http://" . $row['AgentDomain'] . "/Mobile/ShareLink.aspx";
                } else {
                    $shareLink = $domain . "/Mobile/ShareLink.aspx?g=" . $row["GameID"];
                }
            } else {
                if ($row['AgentID'] > 0) {
                    $shareLink = $domain . "/Mobile/AgentShareLinkLua.aspx?g=" . $row["GameID"];
                } else {
                    $shareLink = $domain . "/Mobile/ShareLinkNew.aspx?g=" . $row["GameID"];
                }
            }

        }
        return $shareLink;
    }

    /**
     * 获取U3D推广链接
     * @param array $table
     * @return string
     */
    public static function getU3DSpreadLink(array $table): string
    {
        $shareLink = '';
        if (count($table) > 0) {
            $row       = current($table);
            $webConfig = NativeWebDataProvider::getConfigInfo('WebSiteConfig');  //网站站点配置
            $domain    = empty($webConfig->Field4) ? URL::to('/') : $webConfig->Field4;

            if ($row['AgentID'] > 0) {
                $shareLink = $domain . "/Mobile/AgentShareLink.aspx?g=" . $row["GameID"];
            } else {
                $shareLink = $domain . "/Mobile/ShareLinkNew.aspx?g=" . $row["GameID"];
            }

        }
        return $shareLink;
    }

    /**
     * 构造订单号 (形如:20101201102322159111111)
     * @param $prefix
     * @return bool|string
     */
    public static function getOrderIDByPrefix($prefix)
    {
        $defaultLength = 9;  // 32-9 = 23
        $currentTime   = Carbon::now()->format('YmdHisu') . rand(100, 999); // 20 +3 = 23
        $tradeNoBuffer = $prefix . $currentTime;
        $offset        = strlen($prefix) - $defaultLength;
        if ($offset > 0) {
            $tradeNoBuffer = substr($tradeNoBuffer, 0, -$offset);
        }
        return $tradeNoBuffer;
    }


    /**
     * 1. JSON_UNESCAPED_UNICODE: 遇到中文跳过Unicode编码,直接显示！
     * 2. JSON_NUMERIC_CHECK：数字不要加双引号!
     * 3. JSON_PRESERVE_ZERO_FRACTION: JSON保留零分数!
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function json($data)
    {
        return response()->json($data, 200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_PRESERVE_ZERO_FRACTION);
    }


    /**
     * @return string
     */
    public static function getLineMsg()
    {
        return __CLASS__ . ' / ' . __FUNCTION__ . ' / ' . __LINE__ . ': ';
    }


}