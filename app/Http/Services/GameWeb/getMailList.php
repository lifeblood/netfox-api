<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/23
 * Time: 13:33
 */

namespace App\Http\Services\GameWeb;

use App\Http\Models\GameWeb\PlatformDataProvider;
use App\Http\Services\BaseService;

class getMailList extends BaseService
{
    /**
     * 邮件列表
     * @param $request
     * @return mixed
     */
    public static function getMailList($request) {
        $userId = $request->all()['userid'];
        $index = $request->all()['index'] ?? 1;
        $size = $request->all()['size'] ?? 1;
        $mailList = PlatformDataProvider::getMailList($userId, $index, $size);
        $data = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion' => '20200123',
            'valid' => true,
            'mails' => $mailList->items()
        ];
        return $data;
    }
}