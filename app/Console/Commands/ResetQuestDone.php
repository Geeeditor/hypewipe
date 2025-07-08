<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\QuestJob;
// /usr/local/bin/php /home/hypejizk/public_html/path/to/laravel/artisan quests:reset

class ResetQuestDone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quests:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset quest_done to 0 for all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        QuestJob::query()->update(['quest_done' => 0]);
        $this->info('Quest done reset to 0 for all users.');
    }
}
