<?php

declare(strict_types=1);

use App\Console\Commands\GenerateSitemap;
use App\Enums\BackupSchedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

/*
|--------------------------------------------------------------------------
| Console Routes & Schedule
|--------------------------------------------------------------------------
|
| Closure based console commands and the application's scheduled tasks.
| Since Laravel 11 the console kernel is gone: commands in
| app/Console/Commands are auto-discovered and the schedule lives here.
|
*/

Artisan::command('inspire', function (): void {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

match (config('backup.schedule')) {
    BackupSchedule::DAILY => [
        Schedule::command('backup:clean')->daily()->at('01:00'),
        Schedule::command('backup:run')->daily()->at('01:30'),
    ],
    BackupSchedule::WEEKLY => [
        Schedule::command('backup:clean')->weekly()->at('01:30'),
        Schedule::command('backup:run')->weekly()->at('01:30'),
    ],
    BackupSchedule::MONTHLY => [
        Schedule::command('backup:clean')->monthly()->at('01:00'),
        Schedule::command('backup:run')->monthly()->at('01:30'),
    ],
    default => null,
};

match (config('sitemap.schedule')) {
    1       => Schedule::command(GenerateSitemap::class)->daily(),
    2       => Schedule::command(GenerateSitemap::class)->weekly(),
    3       => Schedule::command(GenerateSitemap::class)->monthly(),
    default => null,
};
