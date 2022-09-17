<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

class IndexController extends Controller
{
    public function home(Request $request)
    {
        $movie_hot = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->get();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->take('15')->get();
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('position', 'ASC')->where('status', 1)->get();
        $country = Country::orderby('position', 'ASC')->where('status', 1)->get();
        $category_home = Category::with('movie', 'movie_category')->orderby('position', 'ASC')->where('status', 1)->get();

        //get ip address
        $user_ip_address = $request->ip();

        //current online
        $visitors_current_online = Visitor::where('ip_address', $user_ip_address)->get();
        $visitor_count = $visitors_current_online->count();
        if ($visitor_count < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
        //total visitor
        $visitors = Visitor::all();
        $visitor_total = $visitors->count();

        return view('pages.home', compact('category', 'genre', 'country', 'category_home', 'movie_hot', 'movie_hot_sidebar', 'visitor_total', 'visitor_count'));
    }
    public function search()
    {
        if (($_GET['search'])) {
            $search = $_GET['search'];
            $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
            $genre = Genre::orderby('position', 'ASC')->where('status', 1)->get();
            $country = Country::orderby('position', 'ASC')->where('status', 1)->get();
            $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->take('15')->get();
            $movie = Movie::where('title', 'LIKE', '%' . $search . '%')->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
            return view('pages.search', compact('category', 'genre', 'country', 'search', 'movie', 'movie_hot_sidebar'));
        } else {
            return redirect()->to('/');
        }
    }
    public function category($slug)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('position', 'ASC')->where('status', 1)->get();
        $country = Country::orderby('position', 'ASC')->where('status', 1)->get();
        $cate_slug = Category::where('slug', $slug)->first();
        //nhieu danh muc
        $movie_category = Movie_Category::where('category_id', $cate_slug->id)->get();
        $many_category = [];
        foreach ($movie_category as $key => $movi) {
            $many_category[] = $movi->movie_id;
        }
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->take('15')->get();
        $movie = Movie::whereIn('id', $many_category)->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.category', compact('category', 'genre', 'country', 'cate_slug', 'movie', 'movie_hot_sidebar'));
    }
    public function year($year)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('position', 'ASC')->where('status', 1)->get();
        $country = Country::orderby('position', 'ASC')->where('status', 1)->get();
        $year = $year;
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->take('15')->get();
        $movie = Movie::where('year', $year)->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.year', compact('category', 'genre', 'country', 'year', 'movie', 'movie_hot_sidebar'));
    }
    public function tag($tag)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('position', 'ASC')->where('status', 1)->get();
        $country = Country::orderby('position', 'ASC')->where('status', 1)->get();
        $tag = $tag;
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->take('15')->get();
        $movie = Movie::where('tags_movie', 'LIKE', '%' . $tag . '%')->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.tag', compact('category', 'genre', 'country', 'tag', 'movie', 'movie_hot_sidebar'));
    }
    public function director($director)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('position', 'ASC')->where('status', 1)->get();
        $country = Country::orderby('position', 'ASC')->where('status', 1)->get();
        $director = $director;
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->take('15')->get();
        $movie = Movie::where('director', 'LIKE', '%' . $director . '%')->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.director', compact('category', 'genre', 'country', 'director', 'movie', 'movie_hot_sidebar'));
    }
    public function cast_movie($cast_movie)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('position', 'ASC')->where('status', 1)->get();
        $country = Country::orderby('position', 'ASC')->where('status', 1)->get();
        $cast_movie = $cast_movie;
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->take('15')->get();
        $movie = Movie::where('cast_movie', 'LIKE', '%' . $cast_movie . '%')->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.cast', compact('category', 'genre', 'country', 'cast_movie', 'movie', 'movie_hot_sidebar'));
    }
    public function genre($slug)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('position', 'ASC')->where('status', 1)->get();
        $country = Country::orderby('position', 'ASC')->where('status', 1)->get();
        $genre_slug = Genre::where('slug', $slug)->first();
        //nhieu the loai
        $movie_genre = Movie_Genre::where('genre_id', $genre_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $movi) {
            $many_genre[] = $movi->movie_id;
        }
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->take('15')->get();
        $movie = Movie::whereIn('id', $many_genre)->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.genre', compact('category', 'genre', 'country', 'genre_slug', 'movie', 'movie_hot_sidebar'));
    }
    public function country($slug)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('position', 'ASC')->where('status', 1)->get();
        $country = Country::orderby('position', 'ASC')->where('status', 1)->get();
        $country_slug = Country::where('slug', $slug)->first();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->take('15')->get();
        $movie = Movie::where('country_id', $country_slug->id)->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.country', compact('category', 'genre', 'country', 'country_slug', 'movie', 'movie_hot_sidebar'));
    }
    public function movie($slug)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('position', 'ASC')->where('status', 1)->get();
        $country = Country::orderby('position', 'ASC')->where('status', 1)->get();
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre')->where('slug', $slug)->where('status', 1)->first();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->take('15')->get();
        $related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)
            ->orderBy(FacadesDB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        //lấy 3 tập gần nhất
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('id', 'DESC')->take(3)->get();
        //lấy tập đầu
        $episode_tapdau = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->take(1)->first();
        //lấy tổng tập phim đã thêm
        $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();

        // $movie_view = Movie::Where('id',$movie->id)->get();
        // $movie->view_count = $movie->view_count + 1;
        // $movie->save();

        return view('pages.movie', compact('category', 'genre', 'country', 'movie', 'related', 'movie_hot_sidebar', 'episode', 'episode_tapdau', 'episode_current_list_count'));
    }
    public function watch($slug, $tap)
    {
        $category = Category::orderby('position', 'ASC')->where('status', 1)->get();
        $genre = Genre::orderby('position', 'ASC')->where('status', 1)->get();
        $country = Country::orderby('position', 'ASC')->where('status', 1)->get();
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre', 'movie_category', 'episode')->where('slug', $slug)->where('status', 1)->first();
        $movie_hot_sidebar = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->take('15')->get();
        $related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)
            ->orderBy(FacadesDB::raw('RAND()'))->whereNotIn('slug', [$slug])->get();
        if (isset($tap)) {
            $tapphim = $tap;
            $tapphim = substr($tap, 4, 20);
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        } else {
            $tapphim = 1;
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        }

        //tao session tinh so luot xem phim
        $sessionKey = 'view_count' . $movie->id;

        $sessionView = FacadesSession::get($sessionKey);
        $post = Movie::findOrFail($movie->id);
        if (!$sessionView) { //nếu chưa có session
            FacadesSession::put($sessionKey, 1); //set giá trị cho session
            $post->increment('view_count');
        }

        //danh gia sao phim
        $rating = Rating::where('movie_id', $movie->id)->avg('rating');
        $rating = round($rating);
        //luot danh gia
        $reviews = Rating::where('movie_id', $movie->id)->count('movie_id');

        return view('pages.watch', compact('category', 'genre', 'country', 'movie', 'movie_hot_sidebar', 'related', 'episode', 'tapphim', 'rating', 'reviews'));
    }
    public function episode()
    {
        return view('pages.episode');
    }
}
