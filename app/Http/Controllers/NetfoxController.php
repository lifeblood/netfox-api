<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/18
 * Time: 13:22
 */

namespace App\Http\Controllers;

use App\Facades\GameServiceFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use App\Http\Services\GameWebService;

use App\Http\Services\FacadeManager;

class NetfoxController extends Controller
{
    protected $gameService;
    private $funcMap, $data;

    public function __construct()
    {
        $this->gameService = app('gameService');
        $this->funcMap = config('NetFox.action');
        $this->data = config('NetFox.jsonMSG');

    }

    public function ApiList()
    {
        $apiList = config('NetFox.action');
        //return response()->json($apiList);
        //Redis::setex('site_name', 10, 'Lumen的redis');
        //return Redis::get('site_name');
        //return Carbon::now()->toDateTimeString();
        //return FacadeManager::getOrderIDByPrefix('QrPayxxxx');
        $dt = Carbon::now();
        echo $dt->copy()->startOfDay();
        echo $dt->copy()->endOfDay();
    }

    public function NewMoblieInterface(Request $request)
    {
        try {
            $actionName = $request->input('action');
            $action = $this->funcMap[$actionName]['serviceName'];

            //$this->data = $this->gameService->{$action}($request);
            $service = GameWebService::getInstance($action);
            $this->data = $service::{$action}($request);
        } catch (\Exception $e) {
            Log::error('NewMoblieInterface error: ' . $e->getMessage());
            $this->data['msg'] .= $e->getMessage();
        }
        return self::json($this->data);
    }


}