<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/23
 * Time: 16:00
 */

namespace App\Http\Services\GameWeb;
use App\Http\Services\BaseService;
use App\Http\Models\GameWeb\TreasureDataProvider;

class agentRank extends BaseService
{
    /**
     * 推广排行
     * @param $request
     * @return mixed
     */
    public static function agentRank($request)
    {
        $userId = $request->all()['userid'];
        $type   = $request->all()['type'];
        $list   = TreasureDataProvider::getAgentRank($userId, $type);
        $own    = TreasureDataProvider::getAgentRankCount($userId, $type);

        $data         = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion' => '20200123',
            'valid'      => true,
            'own'        => $own,
            'list'        => $list
        ];
        return $data;
    }
}