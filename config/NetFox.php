<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/19
 * Time: 11:33
 */

return [
    'jsonMSG' => [
        'code' => '2001',
        'msg' => '抱歉，API参数错误：',
        'data' => [
            'apiVersion' => '20200118',
            'valid' =>  false,
        ]
    ],

    'action' => [
        'getgamelist' => "getMobileGameAndVersion",
        'getgamelist2' => "getMobileGameAndVersion2"
    ]
//,
//
//    'db' => [
//        'Accounts' => env('DB_DATABASE_Accounts'),
//        'Agent' => env('DB_DATABASE_Agent'),
//        'GameMatch' => env('DB_DATABASE_GameMatch'),
//        'GameScore' => env('DB_DATABASE_GameScore'),
//        'Group' => env('DB_DATABASE_Group'),
//        'NativeWeb' => env('DB_DATABASE_NativeWeb'),
//        'Platform' => env('DB_DATABASE_Platform'),
//        'PlatformManager' => env('DB_DATABASE_PlatformManager'),
//        'Record' => env('DB_DATABASE_Record'),
//        'Treasure' => env('DB_DATABASE_Treasure'),
//    ]
];