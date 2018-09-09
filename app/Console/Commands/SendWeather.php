<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;


class SendWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendWeather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '发花粉过敏预报';



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

        $data = httpRequest('http://bj.weather.com.cn');

        preg_match("/<h2 style=\"position\: relative\;\" class=\"weatheH1\">\s+医疗气象指数\((.*?)\)\s+<\/h2>/",$data,$result);//

        preg_match("/<section class=\"detail co\">\s+<aside>(.*?)<\/aside>\s+<a><\/a>\s+<\/section>/",$data,$say);



        $allergy = '';
        if(!empty($result[1]))
        {
            $say[1] = str_replace(["<b>","</b>"],["",","],$say[1]);
            $allergy = '指数:'.$say[1].",".trim($result[1]);
            $allergy = str_replace([",","，"],"\n",$allergy);

        }

        if(!empty($allergy))
        {
            $app = app('wechat.official_account');

            $app->broadcasting->previewText($allergy, 'oD5CP0vCCbDNx1dAdfWEA-yYU7MQ');
            $app->broadcasting->previewText($allergy, 'oD5CP0k-zzGQ8eLNQrlcaWCZP-n0');
        }


    }
}
