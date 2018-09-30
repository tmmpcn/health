<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendNotice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendNotice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '发通知提醒';



    /**
     * Create a new command instance.
     *
     * @return mixed
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
        $app = app('wechat.official_account');
        $app->template_message->send(
            [
            'touser' => 'oD5CP0oapo8I7tFDRJ-1BfiwdsKA',
            'template_id' => 'op0XDQyddXAfWBwvEdqjxadaj9lBp5DJ870AAZadYsk',
            //'url' => 'https://easywechat.org',
            'data' => [
                'first' => '请记得发送今天的血压数据哦',
                'keyword1' => '邓长芬',
                'keyword2' => date("Y-m-d"),
                'remark' => '请每天定时发,天天坚持,棒棒的',

                ],
            ]
        );

    }
}
