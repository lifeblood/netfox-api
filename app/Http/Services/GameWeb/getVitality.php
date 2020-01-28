<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/28
 * Time: 15:46
 */

namespace App\Http\Services\GameWeb;


use App\Http\Models\GameWeb\TreasureDataProvider;
use App\Http\Services\BaseService;

class getVitality extends BaseService
{
    public static function getVitality($request) {
        $userId = $request->input('userid');
        $validBet = TreasureDataProvider::GetValidBetByUid($userId);
        $data         = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion' => '20200123',
            'valid'      => true,
            'tagVilaBet'        => $validBet->TargetBet,
            'currVilaBet'        => $validBet->CurrentValidBet
        ];
        return $data;
    }
}