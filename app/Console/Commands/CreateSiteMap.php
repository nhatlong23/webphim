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
        $sitemap->add(route('homepage'), Carbon::now('Asia/Ho_Chi_Minh'), '1.0', 'daily');
        //get all genre from db
        $genre = Genre::orderBy('id', 'DESC')->get();
        //add genre to sitemap
        foreach ($genre as $genre) {
            $sitemap->add(env('APP_URL') . "the-loai/{$genre->slug}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }
        //get all category from db
        $category = Category::orderBy('id', 'DESC')->get();
        //add Category to sitemap
        foreach ($category as $cate) {
            $sitemap->add(env('APP_URL') . "danh-muc/{$cate->slug}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }
        //get all country from db
        $country = Country::orderBy('id', 'DESC')->get();
        //add country to sitemap
        foreach ($country as $country) {
            $sitemap->add(env('APP_URL') . "quoc-gia/{$country->slug}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }
        //get all movie from db
        $movie = Movie::orderBy('id', 'DESC')->get();
        //add movie to sitemap
        foreach ($movie as $mov) {
            $sitemap->add(env('APP_URL') . "phim/{$mov->slug}", Carbon::now('Asia/Ho_Chi_Minh'), '0.6', 'daily');
        }
        //get all movie_ep from db
        $movie_ep = Movie::with('episode')->orderBy('id', 'DESC')->get();
        //add movie_ep to sitemap
        foreach ($movie_ep as $mov_ep) {
            foreach ($mov_ep->episode as $ep) {
                $sitemap->add(env('APP_URL') . "xem-phim/{$mov_ep->slug}/tap-{$ep->episode}", Carbon::now('Asia/Ho_Chi_Minh'), '0.6', 'daily');
            }
        }
        //get all year
        $year = range(Carbon::now('Asia/Ho_Chi_Minh')->year, 2000);
        foreach ($year as $year) {
            $sitemap->add(env('APP_URL') . "year/{$year}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }
        //generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
        if (File::exists(public_path() . '/sitemap.xml')) {
            File::copy(public_path('sitemap.xml'), base_path('sitemap.xml'));
        }
    }
}
