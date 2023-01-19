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
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->take('15')->get();
        $info = Info::find(1);
        //total admin
        $category_total = Category::all()->count();
        $genre_total = Genre::all()->count();
        $country_total = Country::all()->count();
        $movie_total = Movie::all()->count();

        // tracking user activity
        // $total_user = DB::table('tracking_sessions')->count();
        // $total_user_week = DB::table('tracking_sessions')->where('created_at', '>=', Carbon::now('Asia/Ho_Chi_Minh')->subDay(7))->count();
        // $total_user_month = DB::table('tracking_sessions')->where('created_at', '>=', Carbon::now('Asia/Ho_Chi_Minh')->subMonth())->count();
        // $total_user_3month = DB::table('tracking_sessions')->where('created_at', '>=', Carbon::now('Asia/Ho_Chi_Minh')->subMonth(3))->count();
        // $total_user_year = DB::table('tracking_sessions')->where('created_at', '>=', Carbon::now('Asia/Ho_Chi_Minh')->subYear())->count();


        view()->share([
            'info' => $info,
            'category_home' => $category,
            'genre_home' => $genre,
            'country_home' => $country,
            'movie_hot_sidebar' => $movie_hot_sidebar,
            'category_total' => $category_total,
            'genre_total' => $genre_total,
            'country_total' => $country_total,
            'movie_total' => $movie_total,
            // 'total_user' => $total_user,
            // 'total_user_week' => $total_user_week,
            // 'total_user_month' => $total_user_month,
            // 'total_user_3month' => $total_user_3month,
            // 'total_user_year' => $total_user_year,
        ]);
    }
}
