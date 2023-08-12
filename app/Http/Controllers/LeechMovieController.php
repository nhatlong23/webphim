<?php

namespace App\Http\Controllers;

use App\Models\LeechMovie;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\LinkMovie;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class LeechMovieController extends Controller
{
    public function leech_movie(Request $request)
    {
        $page = $request->input('page', 1);
        $url = "https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=" . $page;
        $resp = Http::get($url)->json();
        $movies = $resp['items'];

        $perPage = count($movies);

        $totalPages = ceil($resp['pagination']['totalItems'] / $perPage);

        $moviesPaginator = new LengthAwarePaginator(
            $movies,
            $resp['pagination']['totalItems'],
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath()]
        );

        $pathImage = $resp['pathImage'];
        $resp_pagination = $resp['pagination'];
        $moviesPaginator->withPath('leech-movie');

        return view('admincp.leech_movie.index', compact('moviesPaginator', 'pathImage', 'resp_pagination'));
    }


    public function checkAndRemoveDuplicateEpisodes()
    {
        $episodeData = [];
    
        Episode::orderBy('id')->chunk(200, function ($episodes) use (&$episodeData) {
            foreach ($episodes as $episode) {
                $key = $episode->linkphim . '|' . $episode->episode;
                if (isset($episodeData[$key])) {
                    $episode->delete();
                } else {
                    $episodeData[$key] = true;
                }
            }
        });
    
        return redirect('movie')->with('success', 'Checked and removed duplicate episodes successfully');
    }


    public function synchronizeAllMovies(Request $request)
    {
        $currentPage = $request->query('page', 1);
        $url = "https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=" . $currentPage;
        $nextPage = $currentPage + 1;
        $nextPageUrl = url()->current() . '?page=' . $nextPage;

        try {
            $resp = Http::get($url)->json();
            $movies = $resp['items'] ?? [];

            foreach ($movies as $movieData) {
                $slug = $movieData['slug'] ?? null;

                if (!$slug) {
                    // If 'slug' key is missing or null, skip this movie data.
                    continue;
                }

                $movie = Movie::where('slug', $slug)->first();

                if (!$movie) {
                    $detailUrl = "https://ophim1.com/phim/" . $slug;

                    try {
                        $detailResp = Http::get($detailUrl)->json();
                        $this->saveMovieData($detailResp['movie'] ?? []);
                    } catch (\Exception $e) {
                        // Log any exceptions when fetching movie details and continue to the next movie.
                        // You can add proper logging here to record the issue.
                        continue;
                    }
                }
            }

            return redirect()->to($nextPageUrl)->with('success', 'Đã đồng bộ tất cả phim thành công');
        } catch (\Exception $e) {
            // If any exception occurs during the synchronization process, handle it here.
            // You can add proper error handling or logging here to record the issue.
            return redirect()->to($currentPage)->with('error', 'Có lỗi xảy ra khi đồng bộ phim');
        }
    }

    // public function synchronizeAllMovies(Request $request)
    // {
    //     $currentPage = $request->input('page', 1);
    //     $url = "https://ophim1.com/danh-sach/phim-moi-cap-nhat?page=" . $currentPage;
    //     $resp = Http::get($url)->json();
    //     $movies = $resp['items'];

    //     foreach ($movies as $movieData) {
    //         $slug = $movieData['slug'];
    //         $movie = Movie::where('slug', $slug)->first();

    //         if (!$movie) {
    //             $detailUrl = "https://ophim1.com/phim/" . $slug;
    //             $detailResp = Http::get($detailUrl)->json();
    //             $this->saveMovieData($detailResp['movie']);
    //         }
    //     }

    //     $totalPages = $resp['pagination']['totalPages'];

    //     return redirect()->back()->with('success', 'Đã đồng bộ tất cả phim thành công');
    // }


    public function synchronizeAllEpisodes()
    {
        $movies = Movie::all();
    
        foreach ($movies as $movie) {
            if (!$movie->episode()->exists()) {
                $this->synchronizeEpisodes($movie);
                $movie->update(['updated_at' => Carbon::now('Asia/Ho_Chi_Minh')]);
            }
        }
    
        return redirect('leech-movie')->with('success', 'Đã đồng bộ tất cả tập phim thành công');
    }


    public function leech_detail($slug)
    {
        $resp = Http::get("https://ophim1.com/phim/" . $slug)->json();
        $resp_movie[] = $resp['movie'];
        return view('admincp.leech_movie.leech_detail', compact('resp_movie'));
    }


    public function leech_store(Request $request, $slug)
    {
        $resp = Http::get("https://ophim1.com/phim/" . $slug)->json();
        $resp_movie[] = $resp['movie'];
        foreach ($resp_movie as $data) {
            $this->saveMovieData($data);
        }
        return redirect()->back()->with('success', 'Thêm mới thành công: ' . $data['name']);
    }

    public function leech_episodes($slug)
    {
        $resp = Http::get("https://ophim1.com/phim/" . $slug)->json();
        return view('admincp.leech_movie.leech_episodes', compact('resp'));
    }

    public function leech_episode_store(Request $request, $slug)
    {
        $movie = Movie::where('slug', $slug)->first();

        if (!$movie) {
            return redirect()->back()->with('error', 'Phim chưa có');
        }

        $this->synchronizeEpisodes($movie);

        $movie->update(['updated_at' => Carbon::now('Asia/Ho_Chi_Minh')]);
        return redirect('leech-movie')->with('success', 'Đã đồng bộ tập phim thành công');
    }

    private function extract_video_code($url)
    {
        $video_code = null;
        // Kiểm tra xem URL có chứa "v=" hay không
        if (strpos($url, 'v=') !== false) {
            $video_code = explode("v=", $url)[1];
            // Nếu URL còn chứa các tham số sau mã video, tách bỏ chúng
            $video_code = strtok($video_code, "&");
        }
        return $video_code;
    }

    private function change_id_country($countryId)
    {
        $idMapping = [
            '62093063196e9f4ab6b448b8' => '2', // ID for China
            '620a2300e0fc277084dfd6d2' => '8', // ID for hàn quốc
            '620a2307e0fc277084dfd726' => '6', //ID for nhật bản
            '620a2318e0fc277084dfd77a' => '10', //ID for thái lan
            '620a231fe0fc277084dfd7ce' => '14', //ID for âu mỹ
            '620a2335e0fc277084dfd822' => '9', //ID for đài loan
            '620a2347e0fc277084dfd876' => '5', //ID for hồng công
            '620a2355e0fc277084dfd8ca' => '3', //ID for ấn độ
            '620a2370e0fc277084dfd91e' => '15', //ID for anh
            '620a2381e0fc277084dfd9c6' => '13', //ID for thổ nhỉ kỳ
            '621674a770b58bba6858b852' => '16', //ID for thổ ý
            '620a2398e0fc277084dfda1a' => '18', //ID for quốc gia khác
            '62159c501f1609c9d934830a' => '17', //ID for brazil
            '6216607570b58bba6858b27c' => '11', //ID for philippin
        ];
        return $idMapping[$countryId] ?? null;
    }

    private function change_id_category_to_genre($genreId)
    {
        $idMapping = [
            '620a21b2e0fc277084dfd0c5' => '3', // ID for Hành Động
            '620a220de0fc277084dfd16d' => '2', // ID for Tình Cảm
            '620a221de0fc277084dfd1c1' => '7', //ID for Hài Hước
            '620a222fe0fc277084dfd23d' => '10', //ID for Cổ Trang
            '620a2238e0fc277084dfd291' => '1', //ID for Tâm lí
            '620a2249e0fc277084dfd2e5' => '8', //ID for Hình Sự
            '620a2253e0fc277084dfd339' => '18', //ID for Chiến Tranh
            '620a225fe0fc277084dfd38d' => '13', //ID for Thể Thao và âm nhạc
            '620a2279e0fc277084dfd3e1' => '9', //ID for Võ Thuật
            '620a2282e0fc277084dfd435' => '4', //ID for Viễn Tưởng
            '620a2293e0fc277084dfd489' => '16', //ID for Phiêu Lưu
            '620a229be0fc277084dfd4dd' => '21', //ID for Khoa Học
            '620a22ace0fc277084dfd531' => '6', //ID for Kinh Dị
            '620a22c8e0fc277084dfd5d9' => '14', //ID for Thần Thoại
            '620e0e64d9648f114cde7728' => '15', //ID for Tài Liệu
            '620e4c0b6ba8271c5eef05a8' => '17', //ID for Gia Đình
            '620f84d291fa4af90ab6b3f4' => '23', //ID for Bí ẩn
            '620f3d2b91fa4af90ab697fe' => '22', //ID for Chính kịch
            '62121e821f1609c9d934585c' => '24', //ID for Học Đường
            '6218eb66a2d0f024a9de48d4' => '25', //ID for Kinh Điển
            '6242b89cc78eb57bbfe29f91' => '26', //ID for Phim 18+
        ];
        $mappedGenres = [];
        foreach ($genreId as $genreId) {
            if (isset($idMapping[$genreId])) {
                $mappedGenres[] = $idMapping[$genreId];
            }
        }

        return $mappedGenres;
    }

    private function saveMovieData($data)
    {
        $movie = new Movie();
        $movie->title = $data['name'];
        $movie->trailer = $this->extract_video_code($data['trailer_url'] ?? null);
        $movie->duration_movie = $data['time'] ?? null;
        $director = isset($data['director']) ? $data['director'] : null;
        $movie->director = is_array($director) ? implode(', ', $director) : null;
        $actors = isset($data['actor']) ? $data['actor'] : null;
        $movie->cast_movie = is_array($actors) ? implode(', ', $actors) : null;
        $movie->episodes = $data['episode_total'] ?? null;
        $movie->tags_movie = $data['name'] . ',' . $data['slug'];
        $movie->resolution = 0;
        $movie->sub_movie = 0;
        $movie->name_en = $data['origin_name'];
        $movie->score_imdb = null;
        $hot_year = $data['year'] ?? null;
        if ($hot_year && intval($hot_year) >= 2023) {
            $movie->movie_hot = 1;
            $movie->topview = 0;
        } else {
            $movie->movie_hot = 0;
            $movie->topview = null;
        }
        $movie->slug = $data['slug'];
        $movie->description = $data['content'] ?? null;
        $movie->image = $data['thumb_url'];
        $movie->status = 1;
        if (array_key_exists('episode_total', $data)) {
            $episode_total = $data['episode_total'];

            // Kiểm tra nếu episode_total tồn tại và có giá trị là số lớn hơn 1 hoặc chứa ký tự '?'
            if ($episode_total && (intval($episode_total) > 1 || strpos($episode_total, '?') !== false)) {
                $movie->thuocphim = 'phimbo';
            } else {
                $movie->thuocphim = 'phimle';
            }
        } else {
            $movie->thuocphim = null;
        }

        $movie->view_count = $data['view'] ?? null;
        $movie->year = $data['year'] ?? null;
        $countryId = $data['country'][0]['id'] ?? null; // Get the first country ID
        $latestCountry = Country::orderBy('id', 'desc')->first();
        $movie->country_id = $this->change_id_country($countryId) ?? $latestCountry->id;
        // Save genres
        $genre_api = $data['category'];
        $genreIds = [];
        foreach ($genre_api as $genreData) {
            $genreId = $genreData['id'] ?? null;
            if ($genreId) {
                $genreIds[] = $genreId;
            }
        }
        // Map genre IDs
        $genreIdMappings = $this->change_id_category_to_genre($genreIds);
        // Save the first genre ID to the movie's genre_id field
        if (!empty($genreIdMappings)) {
            $movie->genre_id = $genreIdMappings[0];
        }
        // Get genres from the database based on the mapped IDs
        $genres = Genre::whereIn('id', $genreIdMappings)->get();

        // Get the default category
        $category = Category::orderBy('id', 'desc')->first();

        $episode_total = $data['episode_total'] ?? null;
        if ($episode_total && (intval($episode_total) > '1' || strpos($episode_total, '?') !== false)) {
            $movie->category_id = 5;
        } else {
            $movie->category_id = $category->id;
        }

        $movie->date_created = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->save();
        // Attach genres to the movie
        if ($genres) {
            $movie->movie_genre()->attach($genres, ['created_at' =>  Carbon::now('Asia/Ho_Chi_Minh')]);
        }
        if ($category) {
            $movie->movie_category()->attach($movie->category_id, ['created_at' =>  Carbon::now('Asia/Ho_Chi_Minh')]);
        }
    }

    private function synchronizeEpisodes(Movie $movie)
    {
        $slug = $movie->slug;
        $movieData = Http::get("https://ophim1.com/phim/" . $slug)->json();
    
        if (empty($movieData['episodes'])) {
            return;
        }
    
        foreach ($movieData['episodes'] as $episodeData) {
            foreach ($episodeData['server_data'] as $serverData) {
                $episodeName = $serverData['name'];
    
                // Check if the episode already exists for this movie
                if (!$this->episodeExists($movie->id, $episodeName)) {
                    $episode = new Episode();
                    $episode->movie_id = $movie->id;
                    $linkEmbed = '<p><iframe allowfullscreen frameborder="0" height="360" scrolling="0" src="' . $serverData['link_embed'] . '" width="100%"></iframe></p>';
                    $episode->linkphim = $linkEmbed;
                    $episode->episode = $episodeName;
                    $linkmovie = LinkMovie::orderBy('id', 'desc')->first();
                    $episode->server = $linkmovie->id;
                    $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                    $episode->save();
                    $episode->update(['updated_at' => Carbon::now('Asia/Ho_Chi_Minh')]);
                }
            }
        }
    }
    

    private function episodeExists($movieId, $episodeName)
    {
        return Episode::where('movie_id', $movieId)->where('episode', $episodeName)->exists();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeechMovie  $leechMovie
     * @return \Illuminate\Http\Response
     */
    public function show(LeechMovie $leechMovie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeechMovie  $leechMovie
     * @return \Illuminate\Http\Response
     */
    public function edit(LeechMovie $leechMovie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeechMovie  $leechMovie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeechMovie $leechMovie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeechMovie  $leechMovie
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeechMovie $leechMovie)
    {
        //
    }
}
