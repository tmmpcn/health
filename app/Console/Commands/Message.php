<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;


class Message extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '消息测试';



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

        $app = app('wechat.official_account');
        //dd($app->user_tag->list());

        $data = $app->user_tag->usersOfTag(102, $nextOpenId = '');

        dd($data);
    }
}
