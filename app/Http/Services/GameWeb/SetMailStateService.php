<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 13:38
 */

namespace App\Http\Services\GameWeb;


use App\Http\Models\GameWeb\PlatformDataProvider;
use App\Http\Services\BaseService;

class SetMailStateService extends BaseService
{
    /**
     * 设置邮件状态
     * @param $request
     * @return mixed
     */
    public static function SetMailState($request) {
        $userId  = $request->input('userid');
        $mid  = $request->input('mid', 0);
        $state  = $request->input('state', 0);

        $data = self::getJsonSuccess();
        $data['code'] = $state > 0 ? 0 : 2001;
        if ($state > 0) {
            $msg = PlatformDataProvider::setMailState($userId, $mid, $state);
            //dd($msg);
            $data['code'] = $msg->code;
            $data['data'] = [
                'apiVersion' => '20200123',
                'valid'      => $msg->code == 0 ? true : false,
                'msg' => $msg->msg
            ];
        }
        return $data;
    }
}