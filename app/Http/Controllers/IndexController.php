<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function home(Request $request)
    {
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = '';
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30);
        $movie_hot = Movie::where('movie_hot', 1)->where('status', 1)->where('date_created', '>=', $sub7days)->inRandomOrder()->get();

        // Kiểm tra xem danh sách phim đã được lưu trong cache chưa
        if (Cache::has('category_home')) {
            // Nếu đã có trong cache, lấy dữ liệu từ cache
            $category_home = Cache::get('category_home');
        } else {
            // Nếu chưa có trong cache, thực hiện truy vấn từ cơ sở dữ liệu
            $category_home = Category::with(['movie_category' => function ($query) {
                $query->where('status', 1)->take(25);
            }])->orderBy('position', 'ASC')->where('status', 1)->get();

            // Lưu danh sách phim vào cache với thời gian sống là 12 giờ
            Cache::put('category_home', $category_home, 12 * 60 * 60); // 60 * 60 là 1 giờ (đơn vị là giây)
        }

        return view('pages.home', compact('category_home', 'movie_hot', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function search()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];

            $meta_title = $search;
            $meta_description = $search;
            $meta_image = '';

            $movie = Movie::where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%')->orWhere('name_en', 'LIKE', '%' . $search . '%');
            })
                ->where('status', 1)->orderBy('date_updated', 'DESC')->paginate(40);
            return view('pages.search', compact('search', 'movie', 'meta_title', 'meta_description', 'meta_image'));
        } else {
            return redirect()->back();
        }
    }

    public function category($slug)
    {
        $cate_slug = Category::where('slug', $slug)->first();
        $meta_title = 'Danh mục: ' . $cate_slug->title;
        $meta_description = $cate_slug->description;
        $meta_image = '';
        //nhieu danh muc
        $movie_category = Movie_Category::where('category_id', $cate_slug->id)->get();
        $many_category = [];
        foreach ($movie_category as $key => $movi) {
            $many_category[] = $movi->movie_id;
        }
        $movie = Movie::whereIn('id', $many_category)->where('status', 1)->orderBy('date_updated', 'DESC')->paginate(40);
        return view('pages.category', compact('cate_slug', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function year($year)
    {
        $year = $year;
        $meta_title = 'Năm phim: ' . $year;
        $meta_description = 'Tìm Năm Phim: ' . $year;
        $meta_image = '';
        $movie = Movie::where('year', $year)->where('status', 1)->orderBy('date_updated', 'DESC')->paginate(40);
        return view('pages.year', compact('year', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function tag($tag)
    {
        $tag = $tag;
        $meta_title = 'Tags: ' . $tag;
        $meta_description = $tag;
        $meta_image = '';
        $movie = Movie::where('tags_movie', 'LIKE', '%' . $tag . '%')->where('status', 1)->orderBy('date_updated', 'DESC')->paginate(40);
        return view('pages.tag', compact('tag', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function director($director)
    {
        $director = $director;
        $meta_title = 'Đạo Diễn: ' . $director;
        $meta_description = ' Tìm kiếm đạo diễn: ' . $director;
        $meta_image = '';
        $movie = Movie::where('director', 'LIKE', '%' . $director . '%')->where('status', 1)->orderBy('date_updated', 'DESC')->paginate(40);
        return view('pages.director', compact('director', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function cast_movie($cast_movie)
    {
        $cast_movie = $cast_movie;
        $meta_title = 'Diễn Viên: ' . $cast_movie;
        $meta_description = ' Tìm kiếm diễn viên: ' . $cast_movie;
        $meta_image = '';
        $movie = Movie::where('cast_movie', 'LIKE', '%' . $cast_movie . '%')->where('status', 1)->orderBy('date_updated', 'DESC')->paginate(40);
        return view('pages.cast', compact('cast_movie', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function genre($slug)
    {
        $genre_slug = Genre::where('slug', $slug)->first();
        $meta_title = 'Thể loại: ' . $genre_slug->title;
        $meta_description = ' Tìm kiếm thể loại: ' . $genre_slug->description;
        $meta_image = '';
        //nhieu the loai
        $movie_genre = Movie_Genre::where('genre_id', $genre_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $movi) {
            $many_genre[] = $movi->movie_id;
        }
        $movie = Movie::whereIn('id', $many_genre)->where('status', 1)->orderBy('date_updated', 'DESC')->paginate(40);
        return view('pages.genre', compact('genre_slug', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function country($slug)
    {
        $country_slug = Country::where('slug', $slug)->first();
        $meta_title = ' Quốc gia: ' . $country_slug->title;
        $meta_description = ' Tìm kiếm quốc gia: ' . $country_slug->description;
        $meta_image = '';
        $movie = Movie::where('country_id', $country_slug->id)->where('status', 1)->orderBy('date_updated', 'DESC')->paginate(40);
        return view('pages.country', compact('country_slug', 'movie', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function movie($slug)
    {
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre')->where('slug', $slug)->where('status', 1)->first();
        $meta_title = $movie->title;
        $meta_description = $movie->description;
        $image_check = substr($movie->image, 0, 4);
        if ($image_check == 'http') {
            $meta_image = $movie->image;
        } else {
            $meta_image = url('uploads/movie/' . $movie->image);
        }
        $related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)
            ->inRandomOrder()->whereNotIn('slug', [$slug])->get();
        //lấy 3 tập gần nhất
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('id', 'DESC')->take(3)->get();
        //lấy tập đầu
        $episode_tapdau = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->take(1)->first();
        //lấy tổng tập phim đã thêm
        $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();

        return view('pages.movie', compact('movie', 'related', 'episode', 'episode_tapdau', 'episode_current_list_count', 'meta_title', 'meta_description', 'meta_image'));
    }
    public function watch($slug, $tap)
    {
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre', 'movie_category', 'episode')->where('slug', $slug)->where('status', 1)->first();
        $meta_title = 'Xem Phim: ' . $movie->title;
        $meta_description = $movie->description;
        $image_check = substr($movie->image, 0, 4);
        if ($image_check == 'http') {
            $meta_image = $movie->image;
        } else {
            $meta_image = url('uploads/movie/' . $movie->image);
        }
        $related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)
            ->inRandomOrder()->whereNotIn('slug', [$slug])->get();
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
        $servers = LinkMovie::orderBy('id', 'ASC')->get();
        $episodes_movies = Episode::where('movie_id', $movie->id)->get()->unique('server');
        $episodes_list = Episode::where('movie_id', $movie->id)->get();

        return view('pages.watch', compact('movie', 'related', 'episode', 'tapphim', 'rating', 'reviews', 'meta_title', 'meta_description', 'meta_image', 'servers', 'episodes_movies', 'episodes_list'));
    }

    public function filter()
    {
        $order = $_GET['order'];
        $genre_get = $_GET['genre'];
        $country_get = $_GET['country'];
        $year_get = $_GET['year'];

        if ($order == '' && $genre_get == '' && $country_get == '' && $year_get == '') {
            return redirect()->back();
        } else {
            //lay du lieu
            $movie_array = Movie::withCount('episode');
            $meta_title = '';
            $meta_description = '';
            $meta_image = '';

            if ($country_get) {
                $movie_array = $movie_array->where('country_id', $country_get);
            }
            if ($year_get) {
                $movie_array = $movie_array->where('year', $year_get);
            }
            if ($order) {
                $movie_array = $movie_array->orderBy($order, 'DESC');
            }
            $movie_array = $movie_array->with('movie_genre');
            $movie = array();
            foreach ($movie_array as $key => $mov) { //liệt kê tất cả phim
                foreach ($mov->movie_genre as $key => $movie_gen) {   //liệt kê tất cả thể loại thuộc id phim
                    $movie = $movie_array->whereIn('genre_id', [$movie_gen->genre_id]);
                }
            }
            $movie = $movie_array->paginate(30);

            return view('pages.filter', compact('movie', 'meta_title', 'meta_description', 'meta_image'));
        }
    }

    public function episode()
    {
        return view('pages.episode');
    }
}
