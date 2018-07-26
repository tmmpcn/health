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

//版本
$router->get('/version', function () use ($router) {
    return $router->app->version();
});

//微信服务器验证
$router->get('/MP_verify_FD2oXGvoHOj2tG9B.txt', function () use ($router) {
    return file_get_contents(dirname(__FILE__)."/MP_verify_FD2oXGvoHOj2tG9B.txt");
});

//微信消息
$router->get('/wechat', 'WeChatController@serve');
$router->post('/wechat', 'WeChatController@serve');

//所有关注的人
$router->get('/openid', 'WeChatController@openid');

//设置菜单
$router->get('/menu', 'WeChatController@menu');


//swagger 文档
$router->get('/swagger', 'SwaggerController@create');

//血压监测接口
$router->group(['prefix' => 'v1'],function () use ($router) {
    $router->post('segment', 'PressureController@segment');


});