<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;


class SendNewStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendNewStock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '发新股申购提醒';



    /**
     * Create a new command instance.
     *
     *
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $data = httpRequest('http://data.eastmoney.com/xg/xg/calendar.html');
        preg_match("/<td valign=\"top\" class=\"today\"><div class=\"cal_date\"><span><\/span>(?:\d+)日<\/div><div class=\"cal_content\"><div class=\"cal_item\"><b>申 购<\/b><ul>(<li><a href=\'\/xg\/detail\/(?:\d+)\.html\' title=\'(?:.*?)\'>(?:.*?)<\/a><\/li>)*<\/ul><\/div>/",iconv('gbk','utf-8',$data),$result);//
        $stock = '';
        if(!empty($result[1]))
        {
            preg_match_all("/title=\'(?:.*?)\'>(.*?)<\/a>/",$result[1],$stock);
            if(!empty($stock[1]))
            {
                $stock = implode(",",$stock[1]);
            }

        }

        if(!empty($stock))
        {
            $app = app('wechat.official_account');
            $app->template_message->send([
                'touser' => 'oD5CP0oapo8I7tFDRJ-1BfiwdsKA',
                'template_id' => 'op0XDQyddXAfWBwvEdqjxadaj9lBp5DJ870AAZadYsk',
                //'url' => 'https://easywechat.org',
                'data' => [
                    'first' => '请记得发送今天的血压数据哦',
                    'keyword1' => '邓长芬',
                    'keyword2' => date("Y-m-d"),
                    'remark' => '请每天定时发,天天坚持,棒棒的',

                ],
            ]);
        }


    }
}
