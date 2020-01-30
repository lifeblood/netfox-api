<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/27
 * Time: 15:18
 */

namespace App\Http\Services\GameWeb;


use App\Http\Models\GameWeb\AccountsDataProvider;
use App\Http\Services\BaseService;
use App\Http\Services\SMS\MessageContext;

class GetCodeService extends BaseService
{
    /**
     * @param $request
     * @return mixed
     */
    public static function getCode($request)
    {
        $result = true;
        $userId = $request->input('userid', 0);
        $Mobile = $request->input('Mobile', 0); //用户标识
        $type   = $request->input('type', 0); //1注册2修改
        if ($Mobile == 0) {
            $data        = self::getJsonFails();
            $data['msg'] = '手机号码不能为空';
            return $data;
        }

        $CheckCodeTime = AccountsDataProvider::getSystemStatusInfo('CheckCodeValidTime')->StatusValue;


        if ($CheckCodeTime > 0) {
            //验证是否在规定时间内重复发送
            $result = AccountsDataProvider::validSendOnTime($Mobile, $CheckCodeTime);
        }

        if (!$result) {
            $data        = self::getJsonSuccess();
            $data['msg'] = '已完成发送，请稍后重试!';
            $data['data'] = [ //帐号已注册
                'apiVersion' => '20200123',
                'valid'      => false
            ];
            return $data;
        }



        if ($userId == 0 || $type > 0) {
            $mobileNum = AccountsDataProvider::getSystemStatusInfo('MolibleNum')->StatusValue;
            $lognum = AccountsDataProvider::getSMSLogCount($Mobile);
            $info = AccountsDataProvider::getAccountsInfoByAccounts($Mobile);
            $data = self::getJsonSuccess();
            if ($type == 1 && $info != null) {
                $data['data'] = [ //帐号已注册
                    'apiVersion' => '20200123',
                    'valid'      => true,
                    'rs'        => -2
                ];
                return $data;
            }

            if ($mobileNum > 0 && $lognum >= $mobileNum) {
                $data['msg'] = '已超过获取验证码限制次数';
                $data['data'] = [ //已超过获取验证码限制次数
                    'apiVersion' => '20200123',
                    'valid'      => true,
                    'rs'        => -1     //已超过获取验证码限制次数
                ];
                return $data;
            }

            if ($type == 2 && $info == null) {
                $data['msg'] = '账号未注册';
                $data['data'] = [ //账号未注册
                    'apiVersion' => '20200123',
                    'valid'      => true,
                    'rs'        => -3     //已超过获取验证码限制次数
                ];
                return $data;
            }

        }

        $msgChannel = config('NetFox.SMS.channel');  //new QixintongMessage()企信通短信接口
        $msgCtx  = new MessageContext($msgChannel);
        $smsNumber = $msgCtx->SendMessage($Mobile);


        if ($smsNumber != '') {
            AccountsDataProvider::insertSMSInfo($Mobile, $smsNumber);

            $data['msg'] = '短信发送成功！';
            $data['data'] = [ //账号未注册
                'apiVersion' => '20200123',
                'valid'      => true,
                'rs'        => 2     //成功
            ];
        } else {
            $data = self::getJsonFails();
            $data['msg'] = '短信发送失败，请查看日志！';
        }
        return $data;
    }
}