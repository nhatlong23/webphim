<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\LeechMovieController;
use Illuminate\Http\Request;

class synchronizeMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronize:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize all movie daily';

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
        $request = new Request(); // Tạo một đối tượng Request tùy theo cách bạn nhận được yêu cầu
        $controller->synchronizeAllMovies($request);
        $this->info('Synchronized all movies successfully.');
    }
}
