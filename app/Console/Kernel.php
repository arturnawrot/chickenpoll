<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\Sitemap\SitemapGenerator;
use App\Models\Poll;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\UpdateThumbnails::Class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('cache:clear')->everyThirtyMinutes();
        $schedule->command('config:clear')->everyThirtyMinutes();
        $schedule->command('config:cache')->everyThirtyMinutes();
        $schedule->command('view:clear')->everyThirtyMinutes();
        // $schedule->command('backup:clean')->daily();
        // $schedule->command('backup:run')->daily();
        $schedule->command('command:thumbnails')->daily();
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
