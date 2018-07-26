<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class SugarNotice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SugarNotice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '发血糖通知提醒';



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
        $openid = ['oD5CP0k-zzGQ8eLNQrlcaWCZP-n0','oD5CP0nnnKtTYRj6nR0pfB2g8_NA'];
        $app = app('wechat.official_account');
        foreach ($openid as $item)
        {
            $app->template_message->send([
                'touser' => $item,//
                'template_id' => '_L9JzBVyIhmxJNWg2unB9fCWINlWHfguVOabo9SQQQo',
                //'url' => 'https://easywechat.org',
                'data' => [
                    'first' => '您好！您有一条血糖测量提醒',
                    'keyword1' => '薰衣草',
                    'keyword2' => "2次/周",
                    'remark' => '您今天该进行血糖测量啦',

                ],
            ]);
        }

    }
}
