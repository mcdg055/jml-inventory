<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateFreshWithSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("running the command: php artisan migrate:fresh --seed");
        Artisan::call('migrate:fresh --seed');

        $this->line(Artisan::output());

        if (Command::SUCCESS == 0) {
            $this->info("success running the command: php artisan migrate:fresh --seed");
        }
    }
}
