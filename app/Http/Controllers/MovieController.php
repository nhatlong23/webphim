<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Movie_Category;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\Rating;
use Carbon\Carbon;
use App\Mail\MoviesNew;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *C
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Movie::with('category', 'movie_genre', 'movie_category', 'country', 'genre')->withCount('episode')->orderBy('id', 'DESC')->paginate(10);
        $movie_all = Movie::select('id', 'title', 'image', 'name_en', 'duration_movie', 'episodes', 'slug')->withCount('episode')->get();
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $path = public_path() . "/json/";
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        File::put($path . 'movies.json', json_encode($movie_all));
        return view('admincp.movie.index', compact('list', 'category', 'country'));
    }

    public function update_moviehot(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->movie_hot = $data['movie_hot'];
        toastr()->success('thành công', 'Cập nhật phim hot thành công!');
        $movie->save();
    }

    public function update_year(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        toastr()->success('thành công', 'Cập nhật năm thành công!');
        $movie->save();
    }

    public function update_season(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->season = $data['season'];
        $movie->save();
    }

    public function update_topview(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->topview = $data['topview'];
        toastr()->success('thành công', 'Cập nhật topview thành công!');
        $movie->save();
    }

    public function filter_topview(Request $request)
    {
        $data = $request->all();
        $movies = Movie::where('topview', $data['value'])->orderBy('view_count', 'DESC')->take(10)->get();

        foreach ($movies as $movie) {
            $resolution_text = '';

            switch ($movie->resolution) {
                case 0:
                    $resolution_text = 'HD';
                    break;
                case 1:
                    $resolution_text = 'SD';
                    break;
                case 2:
                    $resolution_text = 'HDCam';
                    break;
                case 3:
                    $resolution_text = 'Cam';
                    break;
                case 4:
                    $resolution_text = 'FullHD';
                    break;
                default:
                    $resolution_text = 'Trailer';
            }

            $image_url = (strpos($movie->image, 'http') === 0) ? $movie->image : url('uploads/movie/' . $movie->image);

            echo '<div class="item post-37176">
                <a href="' . url('phim/' . $movie->slug) . '" title="' . $movie->title . '">
                    <div class="item-link">
                        <img src="' . $image_url . '" class="lazy post-thumb" alt="' . $movie->title . '" title="' . $movie->title . '" loading="lazy" />
                        <span class="is_trailer">' . $resolution_text . '</span>
                    </div>
                    <p class="title">' . $movie->title . '</p>
                </a>
                <div class="viewsCount" style="color: #9d9d9d;">' . $movie->view_count . ' lượt xem</div>
                <div style="float: left;">
                    <ul class="list-inline rating" title="Average rating">';

            for ($count = 1; $count <= 5; $count++) {
                echo '<li title="rating" style="font-size: 20px; color: #ffcc00; padding:0">&#9733;</li>';
            }

            echo '</ul>
                </div>
            </div>';
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $list_genre = Genre::all();
        $list_category = Category::all();
        return view('admincp.movie.form', compact('category', 'country', 'genre', 'list_genre', 'list_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->trailer = $data['trailer'];
        $movie->duration_movie = $data['duration_movie'];
        $movie->director = $data['director'];
        $movie->cast_movie = $data['cast_movie'];
        $movie->episodes = $data['episodes'];
        $movie->tags_movie = $data['tags_movie'];
        $movie->resolution = $data['resolution'];
        $movie->sub_movie = $data['sub_movie'];
        $movie->name_en = $data['name_en'];
        $movie->score_imdb = $data['score_imdb'];
        $movie->movie_hot = $data['movie_hot'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->thuocphim = $data['thuocphim'];
        // $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->date_created = Carbon::now('Asia/Ho_Chi_Minh');
        //phim nhieu the loai
        foreach ($data['genre'] as $key => $gen) {
            $movie->genre_id = $gen[0];
        }
        //phim nhieu danh muc
        foreach ($data['category'] as $key => $cate) {
            $movie->category_id = $cate[0];
        }
        $get_image = $request->file('image');

        if ($get_image) {
            $original_name = $get_image->getClientOriginalName();
            $public_id = pathinfo($original_name, PATHINFO_FILENAME);
            $uploadedImage = Cloudinary::upload($get_image->getRealPath(), [
                'folder' => 'movie_local',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
                'public_id' => $public_id,
            ]);

            $movie->image = $uploadedImage->getSecurePath();
        }

        $movie->save();
        //them nhieu the loai cho phim
        $movie->movie_genre()->sync($data['genre']);
        //them nhieu danh muc cho phim
        $movie->movie_category()->sync($data['category']);
        return redirect()->route('movie.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $movie = Movie::find($id);
        // Event::fire('movie.view', $movie);

        // return View::make('movie.show')->withMovie($movie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $movie = Movie::find($id);
        $list_genre = Genre::all();
        $list_category = Category::all();
        $movie_genre = $movie->movie_genre;
        $movie_category = $movie->movie_category;
        return view('admincp.movie.form', compact('category', 'country', 'genre', 'movie', 'list_genre', 'movie_genre', 'list_category', 'movie_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminatnreoe\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->trailer = $data['trailer'];
        $movie->duration_movie = $data['duration_movie'];
        $movie->director = $data['director'];
        $movie->cast_movie = $data['cast_movie'];
        $movie->episodes = $data['episodes'];
        $movie->tags_movie = $data['tags_movie'];
        $movie->resolution = $data['resolution'];
        $movie->sub_movie = $data['sub_movie'];
        $movie->name_en = $data['name_en'];
        $movie->score_imdb = $data['score_imdb'];
        $movie->movie_hot = $data['movie_hot'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        // $movie->category_id = $data['category_id'];
        $movie->thuocphim = $data['thuocphim'];
        // $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        //phim nhieu the loai
        foreach ($data['genre'] as $key => $gen) {
            $movie->genre_id = $gen[0];
        }
        //phim nhieu danh muc
        foreach ($data['category'] as $key => $cate) {
            $movie->category_id = $cate[0];
        }

        $get_image = $request->file('image');

        if ($get_image) {
            // Xóa ảnh cũ trên Cloudinary trước khi tải lên ảnh mới
            if ($movie->image) {
                $public_id_old = $movie->image;
                $token = explode('/', $public_id_old);
                $token2 = explode('.', $token[sizeof($token) - 1]);
                // Sử dụng Cloudinary để xóa ảnh cũ
                Cloudinary::destroy('movie/' . $token2[0]);
            }

            $original_name = $get_image->getClientOriginalName();
            $public_id_new = pathinfo($original_name, PATHINFO_FILENAME);

            // Tải ảnh mới lên Cloudinary
            $uploadedImage = Cloudinary::upload($get_image->getRealPath(), [
                'folder' => 'movie_local',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
                'public_id' => $public_id_new,
            ]);

            $movie->image = $uploadedImage->getSecurePath();
        }

        $movie->save();
        //them nhieu the loai cho phim
        $movie->movie_genre()->sync($data['genre']);
        //them nhieu danh muc cho phim
        $movie->movie_category()->sync($data['category']);
        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        if ($movie->image) {
            $public_id_old = $movie->image;
            $token = explode('/', $public_id_old);
            $token2 = explode('.', $token[sizeof($token) - 1]);
            Cloudinary::destroy('movie/' . $token2[0]);
        }
        //xoa nhieu the loai
        Movie_Genre::whereIn('movie_id', [$movie->id])->delete();
        //xoa nhieu danh muc
        Movie_Category::whereIn('movie_id', [$movie->id])->delete();
        //xoa tap phim
        Episode::whereIn('movie_id', [$movie->id])->delete();
        $movie->delete();
        return redirect()->back();
    }

    //them danh gia vao csdl
    public function insert_rating(Request $request)
    {
        $data = $request->all();
        $ip_rating = $request->ip();

        $rating_count = Rating::where('movie_id', $data['movie_id'])->where('ip_rating', $ip_rating)->count();

        if ($rating_count > 0) {
            return 'exist';
        } else {
            $rating = new Rating();
            $rating->movie_id = $data['movie_id'];
            $rating->rating = $data['index'];
            $rating->ip_rating = $ip_rating;
            $rating->date_created = Carbon::now('Asia/Ho_Chi_Minh');
            $rating->save();
            return 'done';
        }
    }

    public function sendEmailNewMovies(Request $request)
    {
        $yearNow = Carbon::now('Asia/Ho_Chi_Minh')->year;

        $customers = Customer::where('verified', 1)->where('locked', 0)->whereNotNull('email')->get();

        foreach ($customers as $customer) {
            $emailedMovies = $customer->emailed_movies ?? [];

            if (!is_array($emailedMovies)) {
                $emailedMovies = [];
            }

            $newMovies = Movie::where('date_created', '>=', Carbon::now('Asia/Ho_Chi_Minh')->subDays(3))
                ->where('year', $yearNow)->whereNotIn('id', $emailedMovies)->get();

            try {
                Mail::to($customer->email)->send(new MoviesNew($newMovies));

                foreach ($newMovies as $movie) {
                    $emailedMovies[] = $movie->id;
                }

                $customer->update(['emailed_movies' => $emailedMovies]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Lỗi khi gửi email cho khách hàng ' . $customer->email . ': ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Gửi mail thành công');
    }

    //thay đổi dữ liệu movie bằng ajax

    // public function category_choose(Request $request)
    // {
    //     $data = $request->all();
    //     $movie = Movie::find($data['movie_id']);
    //     $movie->category_id = $data['category_id'];
    //     $movie->save();
    // }
    public function country_choose(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->country_id = $data['country_id'];
        $movie->save();
    }
    public function watch_video(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $video = Episode::where('movie_id', $data['movie_id'])->where('episode', $data['episode_id'])->first();
        $output['video_title'] = $movie->title . '- tập ' . $video->episode;
        $output['video_desc'] = $movie->description;
        $output['video_link'] = $video->linkphim;

        echo json_encode($output);
    }

    public function search(Request $request)
    {
        $searchKeyword = $request->input('search');

        $list = Movie::with('category', 'movie_genre', 'movie_category', 'country', 'genre')
            ->withCount('episode')
            ->where(function ($query) use ($searchKeyword) {
                $query->where('title', 'LIKE', '%' . $searchKeyword . '%')
                    ->orWhere('name_en', 'LIKE', '%' . $searchKeyword . '%');
            })
            ->orderBy('id', 'DESC')
            ->paginate(30);

        // Trả về view chứa kết quả tìm kiếm
        return view('admincp.movie.search_results', ['movies' => $list]);
    }
}
