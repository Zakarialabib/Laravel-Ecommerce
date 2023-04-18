<?php

declare(strict_types=1);

namespace App\Console;

use App\Enums\BackupSchedule;
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
        if (config('backup.schedule') === BackupSchedule::DAILY) {
            $schedule->command('backup:monitor')->daily()->at('17:00');
            $schedule->command('backup:run')->daily()->at('17:00');
        } elseif (config('backup.schedule') === BackupSchedule::WEEKLY) {
            $schedule->command('backup:monitor')->weekly()->at('17:00');
            $schedule->command('backup:run')->weekly()->at('17:00');
        } elseif (config('backup.schedule') === BackupSchedule::MONTHLY) {
            $schedule->command('backup:monitor')->monthly()->at('17:00');
            $schedule->command('backup:run')->monthly()->at('17:00');
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
