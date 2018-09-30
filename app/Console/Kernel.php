<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\SendNotice::class,
        Commands\SugarNotice::class,
        Commands\SendNewStock::class,
        Commands\SendWeather::class,
        Commands\Message::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
        $schedule->command('SendNotice')->dailyAt('17:30');
        $schedule->command('SugarNotice')->cron('30 17 * * 0');
        $schedule->command('SendNewStock')->cron('0 9 * * 1-5');//新股提醒
        //$schedule->exec('python /www/web/wx_6530_cn/public_html/weibo.py')->dailyAt('16:00');
        $schedule->command('SendWeather')->dailyAt('12:15');//发花粉过敏提醒
    }
}
