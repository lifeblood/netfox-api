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

class AgentRankService extends BaseService
{
    /**
     * 获取推广排行榜信息
     * @param $request
     * @return array
     */
    public static function agentRank($request): array
    {
        $userId = $request->input('userid');
        $type   = $request->input('type');
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