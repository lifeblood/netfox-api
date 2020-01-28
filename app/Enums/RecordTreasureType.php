<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 12:11
 */

namespace App\Enums;


use BenSampo\Enum\Enum;

/**
 * 金币流水类型枚举
 */
class RecordTreasureType extends Enum
{

    /** 后台赠送 */
    const BACKSTAGE_GIFT = 0;
    /** 注册赠送 */
    const REGISTER_GIFT = 1;
    /** 主动转账 */
    const ACTIVE_TRANSFER = 2;
    /** 接收转账 */
    const RECEIVE_TRANSFER = 3;
    /** 购买道具 */
    const BUY_PROPS = 4;
    /** 兑换金币 */
    const EXCHANGE_GOLD_COINS = 5;
    /** 存入银行 */
    const SAVE_IN_BANK = 6;
    /** 银行取出 */
    const TAKE_OUT_BANK = 7;
    /** 银行服务费 */
    const BANK_SERVICE_FEE = 8;
    /** 领取返利 */
    const RECEIVE_REBATES = 9;
    /** 代理赠送 */
    const AGENT_GIFT = 10;
    /** 被代理赠送 */
    const AGENT_IS_GIFTED = 11;
    /** 充值额外赠送 */
    const RECHARGE_EXTRA_GIFT = 12;
    /** 每日分享 */
    const DAILY_SHARE = 13;
    /** 签到 */
    const SIGN_IN = 14;
    /** 比赛奖励 */
    const GAME_REWARD = 15;
    /** 绑定手机 */
    const BIND_MOBILE = 16;
    /** 排行榜奖励 */
    const RANKING_REWARD = 17;
}