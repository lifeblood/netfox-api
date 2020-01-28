<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 16:41
 */

namespace App\Http\Services\GameWeb;


use App\Http\Models\GameWeb\AccountsDataProvider;
use App\Http\Services\BaseService;

class bindingPayee extends BaseService
{
    //绑定支付宝
    public static function bindingPayee($request) {
        $userId = $request->input('userid');
        $type = $request->input('type', 0);
        $acc = $request->input('account');
        $msg = AccountsDataProvider::postBandingPayee($userId, $type, $acc);
        $data['code'] = $msg->code;
        $data['msg'] = $msg->msg;
        $data['data'] = [
            'apiVersion' => '20200123',
            'valid'      => $msg->code == 0 ? true : false
        ];
        return $data;
    }
}