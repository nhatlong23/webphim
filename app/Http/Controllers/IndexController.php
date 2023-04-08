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
use App\Models\Info;
use App\Models\LinkMovie;
use App\Models\Visitor;

use Carbon\Carbon;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Session as FacadesSession;

class IndexController extends Controller
{
    public function home(Request $request)
    {
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = '';

        $movie_hot = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('date_update', 'DESC')->get();
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

        return view('pages.home', compact('category_home', 'movie_hot', 'visitor_total', 'visitor_count', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function search()
    {
        if (($_GET['search'])) {
            $search = $_GET['search'];

            $meta_title = $search;
            $meta_description = $search;
            $meta_image = '';
            $movie = Movie::where('title', 'LIKE', '%' . $search . '%')->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
            return view('pages.search', compact('search', 'movie','meta_title','meta_description','meta_image'));
        } else {
            return redirect()->back();
        }
    }
    public function category($slug)
    {
        $cate_slug = Category::where('slug', $slug)->first();
        $meta_title = $cate_slug->title;
        $meta_description = $cate_slug->description;
        $meta_image = '';
        //nhieu danh muc
        $movie_category = Movie_Category::where('category_id', $cate_slug->id)->get();
        $many_category = [];
        foreach ($movie_category as $key => $movi) {
            $many_category[] = $movi->movie_id;
        }
        $movie = Movie::whereIn('id', $many_category)->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.category', compact('cate_slug', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function year($year)
    {
        $year = $year;
        $meta_title = 'Năm phim: ' . $year;
        $meta_description = 'Tìm Năm Phim: ' . $year;
        $meta_image = '';
        $movie = Movie::where('year', $year)->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.year', compact('year', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function tag($tag)
    {
        $tag = $tag;
        $meta_title = $tag;
        $meta_description = $tag;
        $meta_image = '';
        $movie = Movie::where('tags_movie', 'LIKE', '%' . $tag . '%')->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.tag', compact('tag', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function director($director)
    {
        $director = $director;
        $meta_title = 'Đạo Diễn: ' . $director;
        $meta_description = $director;
        $meta_image = '';
        $movie = Movie::where('director', 'LIKE', '%' . $director . '%')->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.director', compact('director', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function cast_movie($cast_movie)
    {
        $cast_movie = $cast_movie;
        $meta_title = 'Diễn Viên: ' . $cast_movie;
        $meta_description = $cast_movie;
        $meta_image = '';
        $movie = Movie::where('cast_movie', 'LIKE', '%' . $cast_movie . '%')->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.cast', compact('cast_movie', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function genre($slug)
    {
        $genre_slug = Genre::where('slug', $slug)->first();
        $meta_title = $genre_slug->title;
        $meta_description = $genre_slug->description;
        $meta_image = '';
        //nhieu the loai
        $movie_genre = Movie_Genre::where('genre_id', $genre_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $movi) {
            $many_genre[] = $movi->movie_id;
        }
        $movie = Movie::whereIn('id', $many_genre)->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.genre', compact('genre_slug', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function country($slug)
    {
        $country_slug = Country::where('slug', $slug)->first();
        $meta_title = $country_slug->title;
        $meta_description = $country_slug->description;
        $meta_image = '';
        $movie = Movie::where('country_id', $country_slug->id)->where('status', 1)->orderBy('date_update', 'DESC')->paginate(40);
        return view('pages.country', compact('country_slug', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function movie($slug)
    {
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre')->where('slug', $slug)->where('status', 1)->first();
        $meta_title = $movie->title;
        $meta_description = $movie->description;
        $meta_image = url('uploads/movie/' . $movie->image);
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

        return view('pages.movie', compact('movie', 'related', 'episode', 'episode_tapdau', 'episode_current_list_count', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function watch($slug, $tap)
    {
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre', 'movie_category', 'episode')->where('slug', $slug)->where('status', 1)->first();
        $meta_title = 'Xem Phim: ' . $movie->title;
        $meta_description = $movie->description;
        $meta_image = url('uploads/movie/' . $movie->image);
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
        $server = LinkMovie::orderBy('id', 'ASC')->get();

        return view('pages.watch', compact('movie', 'related', 'episode', 'tapphim', 'rating', 'reviews', 'meta_title', 'meta_description', 'meta_image', 'server'));
    }

    public function filter()
    {
        $sapxep = $_GET['order'];
        $genre_get = $_GET['genre'];
        $country_get = $_GET['country'];
        $year_get = $_GET['year'];

        if ($sapxep == '' && $genre_get == '' && $country_get == '' && $year_get == '') {
            return redirect()->back();
        } else {
            //lay du lieu
            $movie = Movie::withCount('episode');
            $meta_title = '';
            $meta_description = '';
            $meta_image = '';
            if ($genre_get) {
                $movie = $movie->where('genre_id', '=', $genre_get);
            } else if ($country_get) {
                $movie = $movie->where('country_id', '=', $country_get);
            } else if ($year_get) {
                $movie = $movie->where('year', '=', $year_get);
            } else if ($sapxep) {
                $movie = $movie->orderBy('date_created', 'DESC');
            }

            $movie = $movie->orderBy('view_count', 'DESC')->paginate(30);
            return view('pages.filter', compact('movie', 'meta_title', 'meta_description', 'meta_image'));
        }
    }

    public function episode()
    {
        return view('pages.episode');
    }
}
