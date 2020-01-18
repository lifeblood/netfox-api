<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/18
 * Time: 13:22
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class BootstrapController extends Controller
{
    public $jsonMSG = [
        'code' => '0',
        'msg' => '',
        'data' => [
            'apiVersion' => '20200118',
            'valid' =>  false,
        ]
    ];

    protected $gameService;

    public function __construct()
    {
        $this->gameService = app('gameService');
    }

    public function init(Request $request)
    {
        return $this->justSwitchAction($request->all());
    }



    protected function justSwitchAction($params)
    {
        try {
            $action = $params['action'];
            switch ($action) {
                case "getgamelist":
                    $this->jsonMSG['data'] = $this->gameService->getMobileGameAndVersion();
                    break;
                default:
                    $this->jsonMSG['code'] = '2001';
                    $this->jsonMSG['msg'] = '抱歉，没有'.$action.'这个方法参数！';
            }

        } catch(\Exception $e) {
            $this->jsonMSG['code'] = '2001';
            $this->jsonMSG['msg'] = '抱歉，URL参数错误：'.$e->getMessage();
        }

       return response()->json($this->jsonMSG);
    }
}