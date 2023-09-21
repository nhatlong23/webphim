<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Info;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Episode;
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
        Paginator::useBootstrap();

        $this->shareGlobalVariables();
    }

    private function shareGlobalVariables()
    {
        view()->share([
            'info' => Info::find(1),
            'category_home' => $this->getActiveCategories(),
            'genre_home' => $this->getActiveGenres(),
            'country_home' => $this->getActiveCountries(),
            'movie_hot_sidebar' => $this->getHotMovies(),
            'currentYear' => Carbon::now()->year,
            'resolutions' => $this->getResolutions(),
            'getMessage' => $this->getMessage(),
        ]);
    }

    private function getActiveCategories()
    {
        return Category::orderBy('position', 'ASC')->where('status', 1)->get();
    }

    private function getActiveGenres()
    {
        return Genre::orderBy('position', 'ASC')->where('status', 1)->get();
    }

    private function getActiveCountries()
    {
        return Country::orderBy('position', 'ASC')->where('status', 1)->get();
    }

    private function getHotMovies()
    {
        return Movie::where('movie_hot', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(20)->get();
    }

    private function getResolutions()
    {
        return [
            0 => 'HD',
            1 => 'SD',
            2 => 'HDCam',
            3 => 'Cam',
            4 => 'FullHD',
            5 => 'Trailer',
        ];
    }

    private function getMessage(){
        $currentYear = Carbon::now()->year;
        $YearCurrent = $currentYear - 1;
        $message = "mới nhất, Tổng hợp danh sách các bộ phim hay được web cập nhật liên tục. Tải hơn 10.000 bộ phim năm $YearCurrent , $currentYear vietsub, thuyết minh mới nhất, hay nhất";
        return $message;   
    }
}
