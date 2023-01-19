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
use Illuminate\Support\Facades\File;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *C
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Movie::with('category', 'movie_genre', 'movie_category', 'country', 'genre')->withCount('episode')->orderby('id', 'DESC')->get();
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $path = public_path() . "/json/";
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        File::put($path . 'movies.json', json_encode($list));
        return view('admincp.movie.index', compact('list', 'category', 'country'));
    }


    public function update_year(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
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
        $movie->save();
    }

    public function filter_topview(Request $request)
    {
        $data = $request->all();
        $movie = Movie::where('topview', $data['value'])->orderBy('view_count', 'DESC')->take(10)->get();
        $output = '';
        foreach ($movie as $key => $mov) {
            if ($mov->resolution == 0) {
                $text = 'HD';
            } elseif ($mov->resolution == 1) {
                $text = 'SD';
            } elseif ($mov->resolution == 2) {
                $text = 'HDCam';
            } elseif ($mov->resolution == 3) {
                $text = 'Cam';
            } elseif ($mov->resolution == 4) {
                $text = 'FullHD';
            } else {
                $text = 'Trailer';
            }
            $output = '<div class="item post-37176">
            <a href=" ' . url('/phim/' . $mov->slug) . ' " title="' . $mov->title . '">
                <div class="item-link">
                    <img src="' . url('uploads/movie/' . $mov->image) . '"
                        class="lazy post-thumb" alt="' . $mov->title . '"
                        title="' . $mov->title . '" />
                    <span class="is_trailer">' . $text . '</span>
                </div>
                <p class="title">' . $mov->title . '</p>
            </a>
            <div class="viewsCount" style="color: #9d9d9d;">  ' . $mov->view_count . ' lượt xem</div>
            <div style="float: left;">
                <ul class="list-inline rating" title="Average rating">
                ';
            for ($count = 1; $count <= 5; $count++) {
                $output .= ' <li title="rating" style="font-size: 20px; color: #ffcc00; padding:0">
                    &#9733;
                </li> ';
            }
            $output .= '<li title="rating" style="font-size: 20px; color: #ffcc00; padding:0">
            </div>
        </div>';
            echo $output;
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
        // $movie->category_id = $data['category_id'];
        $movie->thuocphim = $data['thuocphim'];
        // $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->date_update = Carbon::now('Asia/Ho_Chi_Minh');
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
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/', $new_image);
            $movie->image = $new_image;
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
        $movie->date_update = Carbon::now('Asia/Ho_Chi_Minh');
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
            if (file_exists('uploads/movie/' . $movie->image)) {
                unlink('uploads/movie/' . $movie->image);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/movie/', $new_image);
                $movie->image = $new_image;
            }
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
        if (file_exists('/uploads/movie/' . $movie->image)) {
            unlink('/uploads/movie/' . $movie->image);
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
            echo 'exist';
        } else {
            $rating = new Rating();
            $rating->movie_id = $data['movie_id'];
            $rating->rating = $data['index'];
            $rating->ip_rating = $ip_rating;
            $rating->save();
            echo 'done';
        }
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
}
