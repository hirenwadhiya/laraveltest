<?php

namespace App\Console\Commands;

use App\Jobs\SaveGuardianApiArticlesJob;
use App\Jobs\SaveNewsApiArticlesJob;
use App\Jobs\SaveNYTimesApiArticlesJob;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;

class FetchAndStoreArticlesCommand extends Command
{
    protected $signature = 'store:articles';

    protected $description = 'Fetch and store articles from external APIs';

    public function handle(): void
    {
        SaveNewsApiArticlesJob::dispatch();
        SaveGuardianApiArticlesJob::dispatch();
        SaveNYTimesApiArticlesJob::dispatch();
    }

    public function schedule(Schedule $schedule): void
    {
        $schedule->command('store:articles')->daily();
    }
}
