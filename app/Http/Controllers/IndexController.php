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
use Illuminate\Support\Facades\Auth;
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
        $movie_hot = Movie::where('movie_hot', 1)->where('status', 1)->where('date_created', '>=', $sub7days)->inRandomOrder()->take(10)->get();
        // Kiểm tra xem danh sách phim đã được lưu trong cache chưa
        $category_home = Cache::remember('category_home', 30 * 60, function () {
            return Category::with(['movie_category'])->orderBy('position', 'ASC')->where('status', 1)->get();
        });
        return view('pages.home', compact('movie_hot', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
    
        if (!$search) {
            return redirect()->back();
        }
    
        $meta_title = "Phim $search | $search hay, $search mới, $search hot nhất.";
        $meta_description = "Phim $search | $search hay, $search mới, $search hot nhất.";
        $meta_image = '';
    
        $movies = Movie::where(function ($query) use ($search) {
            $query->where('title', 'LIKE', "%$search%")->orWhere('name_en', 'LIKE', "%$search%");
        })->where('status', 1)->orderBy('updated_at', 'DESC')->paginate(30);
    
        if ($movies->isEmpty()) {
            $noResultsMessage = "Không tìm thấy phim nào phù hợp với '$search'.";
            return view('pages.search', compact('search', 'noResultsMessage', 'meta_title', 'meta_description', 'meta_image'));
        }
    
        return view('pages.search', compact('search', 'movies', 'meta_title', 'meta_description', 'meta_image'));
    }
    

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
    
        if ($category->status === 0) {
            return redirect('/');
        }
    
        $meta_title = "{$category->title} Hay Mới Nhất Chất Lượng Hot Nhất [Tuyển Tập]";
        $meta_description = "{$category->description} Hay Mới Nhất Chất Lượng Hot Nhất [Tuyển Tập]";
        $meta_image = '';
    
        $movieIds = Movie_Category::where('category_id', $category->id)->pluck('movie_id')->toArray();
        
        $movies = Movie::whereIn('id', $movieIds)->where('year', '=', '2023')->where('status', 1)
        ->whereDoesntHave('genre', function ($query) {
            $query->where('status', 0);
        })->orderBy('updated_at', 'DESC')->paginate(30);
    
        return view('pages.category', compact('category', 'movies', 'meta_title', 'meta_description', 'meta_image'));
    }
    
    public function year($year)
    {
        $meta_title = "Phim Năm $year mới nhất, Phim năm $year hay, Phim năm $year hot nhất";
        $meta_description = "Phim Năm $year mới nhất, Phim năm $year hay, Phim năm $year hot nhất";
        $meta_image = '';

        if (!$year) {
            return redirect('/');
        }

        $movies = Movie::where('year', $year)->where('status', 1)->orderBy('updated_at', 'DESC')->paginate(30);
    
        return view('pages.year', compact('year', 'movies', 'meta_title', 'meta_description', 'meta_image'));
    }
    
    public function tag($tag)
    {
        $meta_title = "$tag | $tag hay $tag mới $tag hot nhất";
        $meta_description = "$tag | $tag hay $tag mới $tag hot nhất";
        $meta_image = '';
    
        if (!$tag) {
            return redirect('/');
        }

        $movies = Movie::where('tags_movie', 'LIKE', "%$tag%")->where('status', 1)->orderBy('updated_at', 'DESC')->paginate(30);
    
        return view('pages.tag', compact('tag', 'movies', 'meta_title', 'meta_description', 'meta_image'));
    }
    
    public function director($director)
    {
        $meta_title = "Danh sách phim của đạo diễn $director | Tổng hợp phim do $director";
        $meta_description = "Danh sách phim của đạo diễn $director | Tổng hợp phim do $director";
        $meta_image = '';
    
        if (!$director) {
            return redirect('/');
        }

        $movies = Movie::where('director', 'LIKE', "%$director%")->where('status', 1)->orderBy('updated_at', 'DESC')->paginate(30);
    
        return view('pages.director', compact('director', 'movies', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function cast_movie($cast_movie)
    {
        $meta_title = "Danh sách phim có diễn viên $cast_movie tham gia - Tổng hợp phim của $cast_movie hay nhất";
        $meta_description = "Danh sách phim có diễn viên $cast_movie tham gia - Tổng hợp phim của $cast_movie hay nhất";
        $meta_image = '';

        $movies = Movie::where('cast_movie', 'LIKE', "%$cast_movie%")->where('status', 1)->orderBy('updated_at', 'DESC')->paginate(30);

        return view('pages.cast', compact('cast_movie', 'movies', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function genre($slug)
    {
        $currentYear = Carbon::now()->year;
        $genre = Genre::where('slug', $slug)->first();
    
        if ($genre->status === 0) {
            return redirect('/');
        }
    
        $meta_title = "Phim $genre->title Mới Hay Hot Nhất Năm $currentYear";
        $meta_description = "Phim $genre->description Mới Hay Hot Nhất Năm $currentYear";
        $meta_image = '';
    
        $movieIds = Movie_Genre::where('genre_id', $genre->id)->pluck('movie_id')->toArray();
    
        $movies = Movie::whereIn('id', $movieIds)->where('status', 1)->orderBy('updated_at', 'DESC')->paginate(30);
    
        return view('pages.genre', compact('genre', 'movies', 'meta_title', 'meta_description', 'meta_image'));
    }
    
    public function country($slug)
    {
        $currentYear = Carbon::now()->year;
        $country = Country::where('slug', $slug)->first();
    
        if (!$country) {
            return redirect('/');
        }
    
        $meta_title = "Phim $country->title Mới $currentYear - Tổng Hợp 10k Phim Hay Hot Nhất";
        $meta_description = "Phim $country->description Mới $currentYear - Tổng Hợp 10k Phim Hay Hot Nhất";
        $meta_image = '';
    
        $movies = Movie::where('country_id', $country->id)->where('status', 1)->orderBy('updated_at', 'DESC')->paginate(30);
    
        return view('pages.country', compact('country', 'movies', 'meta_title', 'meta_description', 'meta_image'));
    }
    
    public function movie($slug)
    {
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre')->where('slug', $slug)->where('status', 1)->first();
    
        if (!$movie) {
            return redirect('/');
        }
    
        $meta_title = "$movie->title Full HD VietSub | Xem Phim $movie->name_en";
        $meta_description = "$movie->description Full HD VietSub | Xem Phim $movie->title | Xem Phim $movie->name_en";
    
        // Kiểm tra đường dẫn hình ảnh và tạo đường dẫn đầy đủ nếu cần.
        $meta_image = $movie->image;
        if (substr($meta_image, 0, 4) !== 'http') {
            $meta_image = url('uploads/movie/' . $meta_image);
        }
    
        $related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->inRandomOrder()
            ->where('slug', '!=', $slug) // Loại trừ phim đang xem
            ->take(10)
            ->get();
    
        // Lấy 3 tập gần nhất
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('id', 'DESC')->take(3)->get();
    
        // Lấy tập đầu tiên
        $episode_tapdau = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->first();
    
        // Lấy tổng số tập phim đã thêm
        $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->count();
    
        return view('pages.movie', compact('movie', 'related', 'episode', 'episode_tapdau', 'episode_current_list', 'meta_title', 'meta_description', 'meta_image'));
    }
    
    public function watch($slug, $tap = null)
    {
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre', 'movie_category', 'episode')->where('slug', $slug)->where('status', 1)->first();
    
        if (!$movie) {
            return redirect('/');
        }
    
        $meta_title = "Xem Phim $movie->title Phim $movie->name_en";
        $meta_description = $movie->description;
    
        // Kiểm tra đường dẫn hình ảnh của phim và tạo đường dẫn đầy đủ nếu nó không phải là một URL đầy đủ.
        $meta_image = $movie->image;
        if (substr($meta_image, 0, 4) !== 'http') {
            $meta_image = url('uploads/movie/' . $meta_image);
        }
    
        $related = Movie::with('category', 'genre', 'country')->where('category_id', $movie->category->id)->inRandomOrder()
            ->where('slug', '!=', $slug)
            ->take(10)
            ->get();
    
        if (isset($tap)) {
            $tapphim = $tap;
            $tapphim = substr($tap, 4, 20);
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        } else {
            $tapphim = 1;
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        }
    
        // Tạo session để tính số lượt xem phim
        $sessionKey = 'view_count' . $movie->id;
        $sessionView = FacadesSession::get($sessionKey);
        $post = Movie::findOrFail($movie->id);
        
        if (!$sessionView) {
            FacadesSession::put($sessionKey, 1);
            $post->increment('view_count');
        }
    
        // đánh giá phim
        $rating = Rating::where('movie_id', $movie->id)->avg('rating');
        $rating = round($rating);
    
        // Số lượt đánh giá
        $reviews = Rating::where('movie_id', $movie->id)->count('movie_id');
    
        // Danh sách máy chủ phim và danh sách tập phim
        $servers = LinkMovie::orderBy('id', 'ASC')->get();
        $episodes_movies = Episode::where('movie_id', $movie->id)->get()->unique('server');
        $episodes_list = Episode::where('movie_id', $movie->id)->get();
    
        return view('pages.watch', compact('movie', 'related', 'episode', 'tapphim', 'rating', 'reviews', 'meta_title', 'meta_description', 'meta_image', 'servers', 'episodes_movies', 'episodes_list'));
    }

    public function filter()
    {
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = '';
    
        $order = request('order');
        $genre_get = request('genre');
        $country_get = request('country');
        $year_get = request('year');
    
        $movieQuery = Movie::withCount('episode')->with('movie_genre');
    
        if ($country_get) {
            $movieQuery->where('country_id', $country_get);
        }
        if ($year_get) {
            $movieQuery->where('year', $year_get);
        }
    
        switch ($order) {
            case 'ngaytao':
                $movieQuery->orderBy('created_at', 'DESC');
                break;
            case 'year':
                $movieQuery->orderBy('year', 'DESC');
                break;
            case 'title':
                $movieQuery->orderBy('title', 'ASC');
                break;
            case 'topview':
                $movieQuery->orderBy('view_count', 'DESC');
                break;
            default:
                $movieQuery->orderBy('created_at', 'DESC');
                break;
        }
    
        if ($genre_get) {
            $genreIds = explode(',', $genre_get);
            $movieQuery->whereHas('movie_genre', function ($query) use ($genreIds) {
                $query->whereIn('genre_id', $genreIds);
            });
        }
    
        $movies = $movieQuery->paginate(30);
        toastr()->success('thành công', 'Lọc phim thành công!');
    
        return view('pages.filter', compact('movies', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function profile()
    {
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = '';

        $customer = Auth::guard('customer')->user();
        return view('pages.customers.profile', compact('customer', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function privacy_policy()
    {
        $info = Info::find(1);
        $meta_title = 'Chính sách riêng tư';
        $meta_description = $info->description;
        $meta_image = '';
        $privacy_policy = $info->privacy_policy;
        return view('pages.info.privacy_policy', compact('meta_title', 'meta_description', 'meta_image', 'privacy_policy'));
    }

    public function terms_of_use()
    {
        $info = Info::find(1);
        $meta_title = 'Điều khoản sử dụng';
        $meta_description = $info->description;
        $meta_image = '';
        $terms_of_use = $info->terms_of_use;
        return view('pages.info.terms_of_use', compact('meta_title', 'meta_description', 'meta_image', 'terms_of_use'));
    }

    public function copyright_claims()
    {
        $info = Info::find(1);
        $meta_title = 'Khiếu nại bản quyền';
        $meta_description = $info->description;
        $meta_image = '';
        $copyright_claims = $info->copyright_claims;
        return view('pages.info.copyright_claims', compact('meta_title', 'meta_description', 'meta_image', 'copyright_claims'));
    }

    public function contact()
    {
        $info = Info::find(1);
        $meta_title = 'Liên hệ';
        $meta_description = $info->description;
        $meta_image = '';
        $contact = $info->contact;
        return view('pages.info.contact', compact('meta_title', 'meta_description', 'meta_image', 'contact'));
    }

    public function about_us()
    {
        $info = Info::find(1);
        $meta_title = 'Về chúng tôi';
        $meta_description = $info->description;
        $meta_image = '';
        $about_us = $info->about_us;
        return view('pages.info.about_us', compact('meta_title', 'meta_description', 'meta_image', 'about_us'));
    }

}
