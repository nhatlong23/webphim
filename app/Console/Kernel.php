<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Đặt múi giờ cho Carbon thành múi giờ Việt Nam (Asia/Ho_Chi_Minh)
        // $now = Carbon::now('Asia/Ho_Chi_Minh'); // Múi giờ Việt Nam
    
        $schedule->command('synchronize:movies')->daily()->sendOutputTo(storage_path('logs/scheduler.log'));

        $schedule->command('sitemap:create')->dailyAt('12:26')->sendOutputTo(storage_path('logs/scheduler.log'));

        $schedule->command('synchronize:episodes')->dailyAt('13:40')->sendOutputTo(storage_path('logs/scheduler.log'));
    }
    

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
