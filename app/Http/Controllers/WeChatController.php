<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Support\Facades\DB;
//use \Curl\Curl;
class WeChatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        $app = app('wechat.official_account');
        $app->server->push(function($message){
            switch ($message['MsgType']) {
                case 'text':
                    //preg_match_all("/(\d+)+/",$message['Content'],$return);
                    preg_match_all("/(\d+)(\.\d{1,2})?/",$message['Content'],$return);
                    if(!empty($return[0]))
                    {

                        switch (count($return[0]))
                        {
                            case 4:
                                DB::table('eh')->insert([
                                    'uid'=>2,
                                    '1eh'=>$return[0][0].",".$return[0][1],
                                    '2eh'=>$return[0][2].",".$return[0][3],
                                    'food'=>"",
                                    'work'=>"",
                                    'pill'=>"3,4",
                                    'weather'=>"",
                                    'times'=>date("Y-m-d"),
                                    'post'=>var_export($message,1),
                                ]);

                                return '血压数据收到';
                                break;
                            case 6:
                                DB::table('sugar')->insert([
                                    'uid'=>3,
                                    'am'=>$return[0][0].",".$return[0][1].",".$return[0][2],
                                    'pm'=>$return[0][3].",".$return[0][4].",".$return[0][5],
                                    'times'=>date("Y-m-d"),
                                    'post'=>var_export($message,1),
                                    'ctime'=>date("Y-m-d H:i:s"),
                                ]);

                                return '血糖数据收到';

                                break;
                        }


                    }
                    $mark = mb_substr($message['Content'],0,1);
                    if($mark=='!' || $mark=='！')
                    {
                        return "您提交的血糖数据格式有误\n早晚各一次,一次性发过来\n数据之间可以用任意字符隔开\n如:!3.1*2.2*100*6.1*3.2*300";
                    }else
                    {
                        return "您输入的血压数据格式有误\n早晚各一次,一次性发过来\n数据之间可以用任意字符隔开\n如:114*72*123*74";
                    }
                    break;
            }
        });

        return $app->server->serve();
    }

    /**
     * 获取openid
     *
     * @return void
     */
    public function openid()
    {
        $app = app('wechat.official_account');
        //$app->broadcasting->sendText("大家好！欢迎使用 EasyWeChat。");
        $userList = $app->user->list();
        $users = '';
        if(!empty($userList))
        {
            $users = $app->user->select($userList['data']['openid']);
        }
        echo "<pre>";
        print_r($users);
    }


    public function auth()
    {

        $app = app('wechat.official_account');
        $response = $app->oauth->scopes(['snsapi_userinfo'])
            ->callback('/callback')
            ->redirect();
        //$user = $app->oauth->user();
        //var_dump($user);
        var_dump($response);
    }
    public function menu()
    {


        $app = app('wechat.official_account');

        $app->menu->delete(); // 全部

        exit();
        $buttons = [];
        /*$buttons = [
            [
                "type" => "view",
                "name" => "自选股",
                "url"  => "http://tips.6530.cn/add/"
            ],
            [
                "name"       => "我的",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "自选股",
                        "url"  => "http://tips.6530.cn/list/"
                    ],
                    [
                        "type" => "view",
                        "name" => "说明",
                        "url"  => "http://tips.6530.cn/explain/"
                    ]

                ],
            ],
        ];*/
        $app->menu->create($buttons);
    }
}