<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/19
 * Time: 11:33
 */

return [
    'jsonSuccess' => [
        'code' => 0,
        'msg'  => ''
    ],
    'jsonFails'   => [
        'code' => 2001,
        'msg'  => '抱歉，API参数错误：',
        'data' => [
            'apiVersion' => '20200123',
            'valid'      => false,
        ]
    ],
    'jsonMSG'     => [
        'code' => 2001,
        'msg'  => '抱歉，API参数错误：',
        'data' => [
            'apiVersion' => '20200118',
            'valid'      => false,
        ]
    ],
    'SMS'         => [ //短信发送
        'channel' => 'QixintongMessage',  //默认通道，企信通
        'SMS_content' => '【红牛科技】您的验证码:{code}', //短信模板
        'qixintong'   => [ // 渠道1, 企信通
            'SMS_uid' => '46',
            'SMS_acc' => 'shzx79',
            'SMS_pwd' => '123456',
        ]
    ],
    'redisPrefix' => 'NetFox',

    'turnName'      => [0 => '白银转盘', 1 => '黄金转盘', 3 => '钻石转盘'],
    'operationName' => [
        0  => '后台赠送', 1 => '注册赠送', 2 => '后台赠送',
        3  => '注册赠送', 4 => '后台赠送', 5 => '购买房卡', 6 => '保险箱存入', 7 => '保险箱取出',
        10 => '提现退款', 11 => '提现', 12 => '充值入款', 13 => '代理奖励', 14 => '签到',
        15 => '分享', 16 => '转盘', 17 => 'VIP奖励', 18 => '邮件'
    ],

    'action' => [
        'getgamelist' => "getGameList",                       //[完成]获取游戏列表  client/base/src/app/views/WelcomeScene.lua

        'getagentinfo' => "getAgentInfo",                     //[完成] 获取代理信息 plaza/models/agent/AgentMsg.lua
        'getreward'    => "getReward",                        //[完成] 获取代理奖励
        'rewardrbill'  => "rewardrBill",                      //[完成] 获取领奖列表记录
        'rewardrecord' => "rewardRecord",                     //[完成] 查下级/推广明细
        'agentrank'    => "agentRank",                        //[完成] 获取推广排行榜信息

        'getmaillist' => "getMailList",                       //[完成] 获取邮件列表 loading时候加载   plaza/models/PlazaUIConfig.lua

        'getuserwealth' => "getUserWealth",                   //[完成] 查询用户财富    plaza/views/ClientScene.lua

        'getcode' => "getCode",                               //[完成] 获取手机验证码       plaza/views/layer/logon/AccountRegisteLayer.lua

        'SetMailState' => "SetMailState",                     //[完成] 设置邮件状态  plaza/views/layer/plaza/MailDesLayer.lua

        'getsharereward'     => "getShareReward",             //[完成] 分享玩家彩金  plaza/views/layer/plaza/SpreadLayer.lua
        'sharetimesreward'   => "shareTimesReward",           //[完成] 分享时间奖励  plaza/views/layer/plaza/SpreadLayer.lua
        'receivespreadaward' => "receivespreadaward",         //[没用到] 接受预先奖励  plaza/views/layer/plaza/SpreadLayer.lua

        'GetUserInfo' => "GetUserInfo",                       //[完成] 获取玩家信息  plaza/views/layer/plaza/club/ClubTableInfoLayer.lua

        'GetGroupBattleRecord' => "GetGroupBattleRecord",     //[没用到] 获取小组战斗记录  plaza/views/layer/plaza/club/ClubMyDetailLayer.lua

        'getrankingdata' => "getRankingData",                 //[完成] 获得排名数据  plaza/views/layer/plaza/RankListLayer.lua

        'setpassword'          => "setpassword",              //[没用到] 设置密码  plaza/views/layer/plaza/AgentLayer.lua
        'bindagent'            => "bindagent",                //[没用到]绑定代理  plaza/views/layer/plaza/AgentLayer.lua
        'getreturnawardconfig' => "getreturnawardconfig",     //[没用到]返利比例  plaza/views/layer/plaza/AgentLayer.lua
        'getnicknamebygameid'  => "getnicknamebygameid",      //[没用到]获取昵称

        'buydiam' => "buyDiam",                               //[完成] 金币购买  plaza/views/layer/plaza/DiamondBuyLayer.lua

        'getturntablerecord' => "getTurnTableRecord",         //[完成] 自己的得奖记录  plaza/views/layer/plaza/LuckyLayer.lua
        'getturntablemsg'    => "getTurnTableMsg",            //[完成] 实时滚动数据  plaza/views/layer/plaza/LuckyLayer.lua
        'getturntables'      => "getTurnTables",              //[完成] 转盘数据  plaza/views/layer/plaza/LuckyLayer.lua
        'startturntable'     => "startTurnTable",             //[完成]启动转盘

        'imgpay' => "imgPay",                                 //[完成] QRPAY图片支付     plaza/views/layer/plaza/recharge/RechargeDetail.lua

        'paylist' => "payList",                               //[完成] 支付列表  plaza/views/layer/plaza/recharge/RechargeLayer.lua

        'bindingpayee' => "bindingPayee",                     //[完成] 绑定支付宝 plaza/views/layer/plaza/recharge/WithdrawalLayer.lua
        'withdrawal'   => "withDrawal",                       //[完成] 提现      plaza/views/layer/plaza/recharge/WithdrawalLayer.lua
        'getvilabet'   => "getVitality",                      //[完成] 取得活力      plaza/views/layer/plaza/recharge/WithdrawalLayer.lua

        'bankpay' => "bankPay",                               //[完成] 银行支付信息 plaza/views/layer/plaza/recharge/DetailBank.lua

        'drawalrecord' => "drawalRecord",                     //[完成] 提款记录   plaza/views/layer/plaza/recharge/RecordLayer.lua
        'payrecord'    => "payRecord",                        //[完成] 支付记录   plaza\views\layer\plaza\recharge\RecordLayer.lua

        'getvipinfo'   => "getVipInfo",                       //[完成] 获取VIP信息    plaza/views/layer/plaza/VipLayer.lua
        'getvipreward' => "getVipReward",                     //[完成] 获得VIP奖励    plaza/views/layer/plaza/VipLayer.lua

        'recordtreasuretrade' => "recordTreasureTrade",       //[完成] 金币流水记录   plaza/views/layer/plaza/ucenter/TurnoverInfoLayer.lua
        'recorddiamondstrade' => "recordDiamondsTrade",       //[完成]  钻石流水记录

        'getbattlerecord' => "getbattlerecord",               //请求房间数据    plaza/views/layer/plaza/video/VideoMarkListLayer.lua

        'GetGameIntroList' => "GetGameIntroList",             //请求玩法列表  plaza/views/layer/plaza/PlazaIntroductionLayer.lua

        'receiverankingaward'  => "receiverankingaward",      //领取奖励  plaza/views/layer/plaza/RewardLayer.lua
        'receiveregistergrant' => "receiveregistergrant",     //获得注册补助金  plaza/views/layer/plaza/RewardLayer.lua

        'GetMobileLoginData'  => "getMobileLoginData",        //[完成] 获取手机登录时间    plaza/views/LogonScene.lua
        'getmobileloginlater' => "getMobileLoginLater",       //[完成] 获取手机端登录后数据 loading时候加载  plaza/views/LogonScene.lua

        'getquestionandanswerlist' => "getquestionandanswerlist", // [没有用到] 领取奖励  plaza/views/layer/plaza/HelpLayer.lua
        'getonlinewechatlist' => "getonlinewechatlist",       //[没有用到] 获取在线微信列表  plaza/views/layer/plaza/ShopLayer.lua
        'GetPayProduct'       => "GetPayProduct",             //查询支付产品  plaza/views/layer/plaza/ShopLayer.lua
        'diamondexchgold'     => "diamondexchgold",           //兑换金币  plaza/views/layer/plaza/ShopLayer.lua
        'createpayorder'      => "createpayorder",            //[没用到] 新建支付订单  plaza/views/layer/plaza/ShopLayer.lua
    ]
    ,

    'db' => [
        'Accounts'        => env('DB_DATABASE_Accounts'),
        'Agent'           => env('DB_DATABASE_Agent'),
        'GameMatch'       => env('DB_DATABASE_GameMatch'),
        'GameScore'       => env('DB_DATABASE_GameScore'),
        'Group'           => env('DB_DATABASE_Group'),
        'NativeWeb'       => env('DB_DATABASE_NativeWeb'),
        'Platform'        => env('DB_DATABASE_Platform'),
        'PlatformManager' => env('DB_DATABASE_PlatformManager'),
        'Record'          => env('DB_DATABASE_Record'),
        'Treasure'        => env('DB_DATABASE_Treasure'),
    ]
];