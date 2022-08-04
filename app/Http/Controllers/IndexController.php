<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Episode;
use DB;

class IndexController extends Controller
{
    public function home()
    {
        $movie_hot = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update','DESC')->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update','DESC')->take('15')->get();
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderby('id', 'DESC')->where('status', 1)->get();
        $category_home = Category::with('movie')->orderby('id', 'DESC')->where('status', 1)->get();
        return view('pages.home', compact('category', 'genre', 'country', 'category_home', 'movie_hot','movie_hot_sidebar'));
    }
    public function category($slug)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderby('id', 'DESC')->where('status', 1)->get();
        $cate_slug = Category::where('slug', $slug)->first();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update','DESC')->take('15')->get();
        $movie = Movie::where('category_id', $cate_slug->id)->where('status', 1)->orderBy('date_update','DESC')->paginate(40);
        return view('pages.category', compact('category', 'genre', 'country', 'cate_slug', 'movie','movie_hot_sidebar'));
    }
    public function year($year)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderby('id', 'DESC')->where('status', 1)->get();
        $year = $year;
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update','DESC')->take('15')->get();
        $movie = Movie::where('year', $year)->where('status', 1)->orderBy('date_update','DESC')->paginate(40);
        return view('pages.year', compact('category', 'genre', 'country', 'year', 'movie','movie_hot_sidebar'));
    }
    public function tag($tag)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderby('id', 'DESC')->where('status', 1)->get();
        $tag = $tag;
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update','DESC')->take('15')->get();
        $movie = Movie::where('tags_movie', 'LIKE', '%' .$tag. '%')->where('status', 1)->orderBy('date_update','DESC')->paginate(40);
        return view('pages.tag', compact('category', 'genre', 'country', 'tag', 'movie','movie_hot_sidebar'));
    }
    public function genre($slug)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderby('id', 'DESC')->where('status', 1)->get();
        $genre_slug = Genre::where('slug', $slug)->first();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update','DESC')->take('15')->get();
        $movie = Movie::where('genre_id', $genre_slug->id)->where('status', 1)->orderBy('date_update','DESC')->paginate(40);
        return view('pages.genre', compact('category', 'genre', 'country', 'genre_slug', 'movie','movie_hot_sidebar'));
    }
    public function country($slug)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderby('id', 'DESC')->where('status', 1)->get();
        $country_slug = Country::where('slug', $slug)->first();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update','DESC')->take('15')->get();
        $movie = Movie::where('country_id', $country_slug->id)->where('status', 1)->orderBy('date_update','DESC')->paginate(40);
        return view('pages.country', compact('category', 'genre', 'country', 'country_slug', 'movie','movie_hot_sidebar'));
    }
    public function movie($slug)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderby('id', 'DESC')->where('status', 1)->get();
        $movie = Movie::with('category', 'genre', 'country')->where('slug', $slug)->where('status', 1)->first();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update','DESC')->take('15')->get();
        $related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)
        ->orderBy(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        return view('pages.movie', compact('category', 'genre', 'country', 'movie','related','movie_hot_sidebar'));
    }
    public function watch()
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('id', 'DESC')->where('status', 1)->get();
        $country = Country::orderby('id', 'DESC')->where('status', 1)->get();
        return view('pages.watch', compact('category', 'genre', 'country'));
    }
    public function episode()
    {
        return view('pages.episode');
    }
}
