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
     * @return void
     */
    public function handle()
    {

        $fileName = str_replace("app/Console/Commands", "", trim(dirname(__FILE__)))."public/data/pollen.data";
        $data = file_get_contents($fileName);
        if (!empty($data)) {
            $allergy = str_replace(["#"], "\n", $data);
        }

        if (!empty($allergy)) {
            $app = app('wechat.official_account');

            $app->broadcasting->previewText($allergy, 'oD5CP0vCCbDNx1dAdfWEA-yYU7MQ');

            $app->broadcasting->previewText($allergy, 'oD5CP0k-zzGQ8eLNQrlcaWCZP-n0');

            @unlink($fileName);
        }
    }
}
