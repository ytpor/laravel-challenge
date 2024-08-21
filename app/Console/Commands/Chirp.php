<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Chirp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:chirp {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simple commmand that echo your input.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info($this->argument('message'));
    }
}
