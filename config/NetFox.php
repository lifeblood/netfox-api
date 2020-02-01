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
        'getgamelist' => [
            'serviceName' => 'GetGameList',
            'testCase' => 'action=getgamelist',
        ],                                                    //[完成] 获取游戏列表  client/base/src/app/views/WelcomeScene.lua

        'getagentinfo' => [
            'serviceName' => 'GetAgentInfo',
            'testCase' => 'action=getagentinfo&userid={userId}',
        ],                                                    //[完成] 获取代理信息 plaza/models/agent/AgentMsg.lua
        'getreward'    => [
            'serviceName' => 'GetReward',
            'testCase' => 'action=getreward&userid={userId}',
        ],                                                    //[完成] 获取代理奖励
        'rewardrbill'  => [
            'serviceName' => 'RewardrBill',
            'testCase' => 'action=rewardrbill&userid={userId}',
        ],                                                    //[完成] 获取领奖列表记录
        'rewardrecord' => [
            'serviceName' => 'RewardRecord',
            'testCase' => 'action=rewardrecord&userid={userId}',
        ],                                                    //[完成] 查下级/推广明细
        'agentrank'    => [
            'serviceName' => 'AgentRank',
            'testCase' => 'action=agentrank&userid={userId}&type=1',
        ],                                                    //[完成] 获取推广排行榜信息

        'getmaillist' => [
            'serviceName' => 'GetMailList',
            'testCase' => 'action=getmaillist&userid={userId}&type=1',
        ],                                                     //[完成] 获取邮件列表 loading时候加载   plaza/models/PlazaUIConfig.lua

        'getuserwealth' => [
            'serviceName' => 'GetUserWealth',
            'testCase' => 'action=getuserwealth&userid={userId}',

        ],                                                      //[完成] 查询用户财富    plaza/views/ClientScene.lua

        'getcode' => [
            'serviceName' => 'GetCode',
            'testCase' => 'action=getcode&Mobile={Mobile}&typeid=0',
        ],                                                      //[完成] 获取手机验证码       plaza/views/layer/logon/AccountRegisteLayer.lua

        'SetMailState' => [
            'serviceName' => 'SetMailState',
            'testCase' => 'action=SetMailState&userid={userId}&mid={mid}&state={state}',
        ],                                                       //[完成] 设置邮件状态  plaza/views/layer/plaza/MailDesLayer.lua

        'getsharereward'     => [
            'serviceName' => "GetShareReward",
            'testCase' => 'action=getsharereward&userid={userId}',
        ],                                                      //[完成] 分享玩家彩金  plaza/views/layer/plaza/SpreadLayer.lua
        'sharetimesreward'   => [
            'serviceName' => 'ShareTimesReward',
            'testCase' => 'action=sharetimesreward&userid={userId}',
        ],                                                      //[完成] 分享时间奖励  plaza/views/layer/plaza/SpreadLayer.lua
        'receivespreadaward' => "receivespreadaward",         //[没用到] 接受预先奖励  plaza/views/layer/plaza/SpreadLayer.lua

        'GetUserInfo' => [
            'serviceName' => 'GetUserInfo',
            'testCase' => 'action=GetUserInfo&userid={userId}',
        ],                                                     //[完成] 获取玩家信息  plaza/views/layer/plaza/club/ClubTableInfoLayer.lua

        'GetGroupBattleRecord' => "GetGroupBattleRecord",      //[没用到] 获取小组战斗记录  plaza/views/layer/plaza/club/ClubMyDetailLayer.lua

        'getrankingdata' => [
            'serviceName' => 'GetRankingData',
            'testCase' => 'action=getrankingdata&userid={userId}&typeid={typeid}',
        ],                                                     //[完成] 获得排名数据  plaza/views/layer/plaza/RankListLayer.lua

        'setpassword'          => "setpassword",              //[没用到] 设置密码  plaza/views/layer/plaza/AgentLayer.lua
        'bindagent'            => "bindagent",                //[没用到]绑定代理  plaza/views/layer/plaza/AgentLayer.lua
        'getreturnawardconfig' => "getreturnawardconfig",     //[没用到]返利比例  plaza/views/layer/plaza/AgentLayer.lua
        'getnicknamebygameid'  => "getnicknamebygameid",      //[没用到]获取昵称

        'buydiam' => [
            'serviceName' => 'BuyDiam',
            'testCase' => 'action=buydiam&userid={userId}',
        ],                               //[完成] 金币购买  plaza/views/layer/plaza/DiamondBuyLayer.lua

        'getturntablerecord' => [
            'serviceName' => 'GetTurnTableRecord',
            'testCase' => 'action=getturntablerecord&userid={userId}',
        ],                                                    //[完成] 自己的得奖记录  plaza/views/layer/plaza/LuckyLayer.lua
        'getturntablemsg'    => [
            'serviceName' => 'GetTurnTableMsg',
            'testCase' => 'action=getturntablemsg&userid={userId}',
        ],                                                    //[完成] 实时滚动数据  plaza/views/layer/plaza/LuckyLayer.lua
        'getturntables'      => [
            'serviceName' => 'GetTurnTables',
            'testCase' => 'action=getturntables&userid={userId}',
        ],                                                    //[完成] 转盘数据  plaza/views/layer/plaza/LuckyLayer.lua
        'startturntable'     => [
           'serviceName' => "StartTurnTable",
           'testCase' => 'action=startturntable&userid={userId}&index={index}',
        ],                                                    //[完成]启动转盘

        'imgpay' => [
            'serviceName' => "ImgPay",
            'testCase' => 'action=imgpay&userid={userId}',
        ],                                                    //[完成] QRPAY图片支付     plaza/views/layer/plaza/recharge/RechargeDetail.lua

        'paylist' => [
            'serviceName' => 'payList',
            'testCase' => 'action=paylist&userid={userId}',
        ],                                                    //[完成] 支付列表  plaza/views/layer/plaza/recharge/RechargeLayer.lua

        'bindingpayee' => [
            'serviceName' => 'BindingPayee',
            'testCase' => 'action=bindingpayee&userid={userId}',
        ],                                                    //[完成] 绑定支付宝 plaza/views/layer/plaza/recharge/WithdrawalLayer.lua
        'withdrawal'   => [
            'serviceName' => 'WithDrawal',
            'testCase' => 'action=withdrawal&userid={userId}',
        ],                                                    //[完成] 提现      plaza/views/layer/plaza/recharge/WithdrawalLayer.lua
        'getvilabet'   => [
            'serviceName' => 'GetVitality',
            'testCase' => 'action=getvilabet&userid={userId}',
            ],                                                 //[完成] 取得活力      plaza/views/layer/plaza/recharge/WithdrawalLayer.lua

        'bankpay' => [
            'serviceName' => 'BankPay',
            'testCase' => 'action=bankpay&userid={userId}',
        ],                                                     //[完成] 银行支付信息 plaza/views/layer/plaza/recharge/DetailBank.lua

        'drawalrecord' => [
            'serviceName' => 'DrawalRecord',
            'testCase' => 'action=drawalrecord&userid={userId}&index={index}',
        ],                                                     //[完成] 提款记录   plaza/views/layer/plaza/recharge/RecordLayer.lua
        'payrecord'    => [
            'serviceName' => 'PayRecord',
            'testCase' => 'action=payrecord&userid={userId}&index={index}',
        ],                                                     //[完成] 支付记录   plaza\views\layer\plaza\recharge\RecordLayer.lua

        'getvipinfo'   => [
            'serviceName' => 'GetVipInfo',
            'testCase' => 'action=getvipinfo&userid={userId}',
            ],                                                  //[完成] 获取VIP信息    plaza/views/layer/plaza/VipLayer.lua
        'getvipreward' => [
            'serviceName' => 'GetVipReward',
            'testCase' => 'action=getvipreward&userid={userId}&type={type}',
        ],                                                      //[完成] 获得VIP奖励    plaza/views/layer/plaza/VipLayer.lua

        'recordtreasuretrade' => [
            'serviceName' => 'RecordTreasureTrade',
            'testCase' => 'action=recordtreasuretrade&userid={userId}',
        ],                                                     //[完成] 金币流水记录   plaza/views/layer/plaza/ucenter/TurnoverInfoLayer.lua
        'recorddiamondstrade' => [
            'serviceName' => "RecordDiamondsTrade",
            'testCase' => 'action=recorddiamondstrade&userid={userId}',
            ],                                                  //[完成]  钻石流水记录

        'getbattlerecord' => [
            'serviceName' => 'GetBattleRecord',
            'testCase' => 'action=getbattlerecord&typeid={typeid}&userid={userId}',
        ],                                                       //请求房间数据    plaza/views/layer/plaza/video/VideoMarkListLayer.lua

        'GetGameIntroList' => "GetGameIntroList",             //请求玩法列表  plaza/views/layer/plaza/PlazaIntroductionLayer.lua

        'receiverankingaward'  => "receiverankingaward",      //领取奖励  plaza/views/layer/plaza/RewardLayer.lua
        'receiveregistergrant' => "receiveregistergrant",     //获得注册补助金  plaza/views/layer/plaza/RewardLayer.lua

        'GetMobileLoginData'  => [
            'serviceName' => 'GetMobileLoginData',
            'testCase' => 'action=GetMobileLoginData&userid={userId}',
        ],                                                    //[完成] 获取手机登录时间    plaza/views/LogonScene.lua
        'getmobileloginlater' => [
            'serviceName' => 'GetMobileLoginLater',
            'testCase' => 'action=getmobileloginlater&userid={userId}',
        ],                                                     //[完成] 获取手机端登录后数据 loading时候加载  plaza/views/LogonScene.lua

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