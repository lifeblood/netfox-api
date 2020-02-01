<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/31
 * Time: 17:33
 */

namespace App\Http\Services\GameWeb;


use App\Http\Models\GameWeb\PlatformDataProvider;
use App\Http\Services\BaseService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class GetBattleRecordService extends BaseService
{
    public static function getBattleRecord($request) {
        $validator = Validator::make(
            $request->all(), [
            'userid' => 'required',
            'typeid' => 'required'
        ]);

        if ($validator->fails()) {
            $data = self::getJsonFails();
            $data['msg'] = $validator->errors();
            return $data;
        }

        $userId = $request->input('userid');
        $typeId = $request->input('typeid');

        $bList = null;
        $sList = null;
        $list = PlatformDataProvider::getHallBattleRecord($userId, $typeId);

        if ($typeId >= 2) {
            $dscore = $list[0];
            $draw = $list[1];
            $game = $list[2];

            foreach ($dscore as $key => $item) {
                $sList[] = [
                    'KindID' => $item['KindID'],
                    'KindName' => isset(current($game)['KindName']) ? current($game)['KindName'] : '',
                    'GameTime' => Str::substr($item['InsertTime'],0,19),
                    'UserCount' => isset(current($draw)['UserCount']) ? current($draw)['UserCount'] : '',
                    'Score' => $item['Score']
                ];
            }
        } else {
            $battleinfo = $list[0];
            $game = $list[1];
            $user = $list[2];
            $battle = $list[4];
            $host = $list[3];

            if (count($battle) > 0) {
                //获取战绩
                foreach ($battle as $key => $item) {
                    $bList[] = [
                        'KindID' => $item['KindID'],
                        'RoomHostID' => $item['RoomHostID'],
                        'KindName' => isset(current($game)['KindName']) ? current($game)['KindName'] : '',
                        'BaseScore' => $item['CellScore'],
                        'RoomID' => $item['RoomID'],
                        'Score' => $item['Score'],
                        'GUID' => $item['PersonalRoomGUID'],
                        'StartTime' => Str::substr($item['StartTime'],0,19),
                        'GameID' => isset(current($host)['GameID']) ? current($host)['GameID'] : '',
                        'NickName' => isset(current($host)['NickName']) ? current($host)['NickName'] : '',
                        'PlayBackCode' => $item['PlayBackCode'],
                        'ChairID' => $item['ChairID'],
                    ];


                    //获取局数
                    $drow = current($battleinfo)->RoomID;

                }
            }
       }
        $data = self::getJsonSuccess();
        $data['data'] = [
            'apiVersion' => '20200123',
            'valid'      => true,
            'bList'        => $bList,
            'sList'        => $sList
        ];

        return $data;
    }
}