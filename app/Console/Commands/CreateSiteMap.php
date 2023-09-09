<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Movie_Category;
use App\Models\Movie_Genre;
use App\Models\Rating;
use App\Models\Visitor;
use Carbon\Carbon;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $sitemap = App::make('sitemap');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $sitemap->add(route('homepage'), $now, '1.0', 'daily');
        //get all genre from db
        $genre = Genre::orderBy('id', 'DESC')->get();
        //add genre to sitemap
        foreach ($genre as $genre) {
            $sitemap->add(env('APP_URL') . "/the-loai/{$genre->slug}", $now, '0.9', 'daily');
        }
        //get all category from db
        $category = Category::orderBy('id', 'DESC')->get();
        //add Category to sitemap
        foreach ($category as $cate) {
            $sitemap->add(env('APP_URL') . "/danh-muc/{$cate->slug}", $now, '0.9', 'daily');
        }
        //get all country from db
        $country = Country::orderBy('id', 'DESC')->get();
        //add country to sitemap
        foreach ($country as $country) {
            $sitemap->add(env('APP_URL') . "/quoc-gia/{$country->slug}", $now, '0.9', 'daily');
        }

        // get all movie from db
        $movies = Movie::orderBy('id', 'DESC')->chunk(100, function ($chunk) use ($sitemap, $now) {
            foreach ($chunk as $mov) {
                $sitemap->add(env('APP_URL') . "/phim/{$mov->slug}", $now, '0.7', 'daily');
            }
        });
        

        // //get all movie_ep from db
        // $movies = Movie::with('episode')->orderBy('id', 'DESC')->get();
        // foreach ($movies as $mov) {
        //     foreach ($mov->episode as $ep) {
        //         $sitemap->add(env('APP_URL') . "xem-phim/{$mov->slug}/tap-{$ep->episode}", $now, '0.6', 'daily');
        //     }
        // }

        //get all year
        $year = range($now->year, 2000);
        foreach ($year as $year) {
            $sitemap->add(env('APP_URL') . "/year/{$year}", $now, '0.9', 'daily');
        }
        //generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
        if (File::exists(public_path() . '/sitemap.xml')) {
            File::copy(public_path('sitemap.xml'), base_path('sitemap.xml'));
        }
    }
}
