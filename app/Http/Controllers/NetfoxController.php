<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/18
 * Time: 13:22
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NetfoxController extends Controller
{
    protected $gameService;

    public function __construct()
    {
        $this->gameService = app('gameService');
    }

    public function ApiList()
    {
        $apiList = config('NetFox.action');
        return response()->json($apiList);
    }

    public function NewMoblieInterface(Request $request)
    {
        try {
            $action  = $request->all()['action'];
            $jsonMSG = $this->gameService->factory($action, $request);
        } catch (\Exception $e) {
            $jsonMSG = config('NetFox.jsonMSG');
            Log::error('JSON: xxxx' . $e->getPrevious());
            $jsonMSG['msg'] .= $e->getMessage();
        }
        return response()->json($jsonMSG);
    }
}