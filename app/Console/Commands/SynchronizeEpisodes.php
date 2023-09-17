<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\LeechMovieController;

class SynchronizeEpisodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronize:episodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize all episodes daily';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controller = new LeechMovieController();
        $controller->synchronizeAllEpisodes();
        $this->info('Synchronized all episodes successfully.');
    }
}
