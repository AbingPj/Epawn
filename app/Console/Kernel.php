<?php

namespace App\Console;

use App\Events\EpawnEvent;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        
        $schedule->call(function () {
            broadcast(new EpawnEvent('schedule Call'));
        })->everyFiveMinutes();

        $schedule->command('epawn:send-email')->everyFiveMinutes();
        $schedule->command('epawn:send-confiscation')->everyFiveMinutes();
        $schedule->command('epawn:send-penalty')->everyFiveMinutes();
        $schedule->command('epawn:update-expiration')->everyFiveMinutes();

        // go daddy cronjob call
        // /usr/local/bin/php /home/dwk82pa7p1tk/public_html/epawn/artisan schedule:run >> /dev/null 2>&1
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
