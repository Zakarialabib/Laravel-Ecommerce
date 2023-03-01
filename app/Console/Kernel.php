<?php

declare(strict_types=1);

namespace App\Console;

use App\Console\Commands\Backup;
use App\Console\Commands\GenerateSitemap;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Backup::class,
        GenerateSitemap::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //  some config somewhere
        if (config('backup.schedule') === 1) {
            $schedule->command(Backup::class)->daily();
        } elseif (config('backup.schedule') === 2) {
            $schedule->command(Backup::class)->weekly();
        } elseif (config('backup.schedule') === 3) {
            $schedule->command(Backup::class)->monthly();
        }

        if (config('sitemap.schedule') === 1) {
            $schedule->command(GenerateSitemap::class)->daily();
        } elseif (config('sitemap.schedule') === 2) {
            $schedule->command(GenerateSitemap::class)->weekly();
        } elseif (config('sitemap.schedule') === 3) {
            $schedule->command(GenerateSitemap::class)->monthly();
        }
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
