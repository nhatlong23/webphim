<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Info;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('position', 'ASC')->where('status', 1)->get();
        $country = Country::orderby('position', 'ASC')->where('status', 1)->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take('20')->get();
        $info = Info::find(1);
        $currentYear = Carbon::now()->year;

        Paginator::useBootstrap();

        view()->share([
            'info' => $info,
            'category_home' => $category,
            'genre_home' => $genre,
            'country_home' => $country,
            'movie_hot_sidebar' => $movie_hot_sidebar,
            'currentYear' => $currentYear,
        ]);
    }
}
