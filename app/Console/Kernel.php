<?php

declare(strict_types=1);

namespace App\Console;

use App\Enums\BackupSchedule;
use App\Console\Commands\GenerateSitemap;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
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
        if (config('backup.schedule') === BackupSchedule::DAILY) {
            $schedule->command('backup:clean')->daily()->at('01:00');
            $schedule->command('backup:run')->daily()->at('01:30');
        } elseif (config('backup.schedule') === BackupSchedule::WEEKLY) {
            $schedule->command('backup:clean')->weekly()->at('01:30');
            $schedule->command('backup:run')->weekly()->at('01:30');
        } elseif (config('backup.schedule') === BackupSchedule::MONTHLY) {
            $schedule->command('backup:clean')->monthly()->at('01:00');
            $schedule->command('backup:run')->monthly()->at('01:30');
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
