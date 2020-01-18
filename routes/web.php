<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return 'hello world';
});


$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->get('test', 'ExampleController@test');
});

$router->group(['prefix' => 'WS'], function () use ($router) {
    $router->get('NewMoblieInterface.ashx', 'BootstrapController@init');
});