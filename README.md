# 网狐前端COCOS API /  Powered by Lumen PHP Framework

## 重构目的

跳出MS平台，拥抱Linux, 提升平台的稳定性和可扩展性。

## 项目遵循面向对象设计五个基本原则

| I | LOVE| YOU |
| :-----| ----: | :----: |
| S | 单一功能原则 | 认为对象应该仅具有一种单一功能的概念。 |
| O | 开闭原则 | 认为“软件体应该是对于扩展开放的，但是对于修改封闭的”的概念。 |
| L | 里氏替换原则 | 认为“程序中的对象应该是可以在不改变程序正确性的前提下被它的子类所替换的”的概念。 参考契约式设计。 |
| I | 接口隔离原则 | 认为“多个特定客户端接口要好于一个宽泛用途的接口” |
| D | 依赖反转原则 |认为一个方法应该遵从“依赖于抽象而不是一个实例” 依赖注入是该原则的一种实现方式。|

## 涉及数据库

关系数据库：SQL SERVER 2008 R2

缓存数据库: Redis



## PHPUnit 单元测试

````
所有接口都支持PHPUint 单元测试

单元测试程序目录： ./tests/GameWeb/*
配置文件：phpunit.xml
批量执行命令：phpunit
单个执行命令：phpunit ./tests/GameWeb/RewardRecordTest.php

执行结果：
phpunit 
PHPUnit 7.0.3 by Sebastian Bergmann and contributors.
............................                                      28 / 28 (100%)

````


## 接口列表如下：

```php
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
```
