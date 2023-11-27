<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Episode;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;
use PragmaRX\Tracker\Vendor\Laravel\Support\Session;

use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $sessions = Tracker::sessions();
        //total admin
        $category_total = Category::count();
        $genre_total = Genre::count();
        $country_total = Country::count();
        $movie_total = Movie::count();
        $episode_total = Episode::count();
        return view('layouts.home', compact('sessions','category_total','genre_total','country_total','movie_total','episode_total'));
    }
}
