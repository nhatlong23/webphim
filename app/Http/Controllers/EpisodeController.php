<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\LinkMovie;
use Carbon\Carbon;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_episode = Episode::with('movie')->orderBy('movie_id', 'DESC')->get();
        $list_server = LinkMovie::orderBy('id', 'DESC')->get();
        return view('admincp.episodes.index', compact('list_episode', 'list_server'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_movie = Movie::orderBy('id', 'DESC')->pluck('title', 'id');
        return view('admincp.episodes.form', compact('list_movie'));
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
        // $episode_check = Episode::where('movie_id', $data['movie_id'])->where('episode', $data['episode'])->first();
        // $server_check =  Episode::where('movie_id', $data['movie_id'])->where('server', $data['linkserver'])->first();

        // if ($server_check) {
        //     return redirect()->back()->with('error', 'Tập phim hoặc Máy chủ đã tồn tại');
        // } else {
        $episode = new Episode();
        $episode->movie_id = $data['movie_id'];
        $episode->linkphim = $data['link'];
        $episode->episode = $data['episode'];
        $episode->server = $data['linkserver'];
        $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
        return redirect()->back()->with('success', 'Thêm mới thành công');
    }

    public function add_episode($id)
    {
        $movie = Movie::find($id);
        $linkmovie = LinkMovie::orderBy('id', 'DESC')->pluck('title', 'id');
        $list_server = LinkMovie::orderBy('id', 'DESC')->get();
        $list_episode = Episode::with('movie')->where('movie_id', $id)->orderBy('episode', 'DESC')->get();
        return view('admincp.episodes.add_episode', compact('list_episode', 'movie', 'linkmovie', 'list_server'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $linkmovie = LinkMovie::orderBy('id', 'DESC')->pluck('title', 'id');
        $list_movie = Movie::orderBy('id', 'DESC')->pluck('title', 'id');
        $episode = Episode::find($id);
        return view('admincp.episodes.form', compact('episode', 'list_movie', 'linkmovie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $episode = Episode::find($id);
        $episode->movie_id = $data['movie_id'];
        $episode->linkphim = $data['link'];
        $episode->server = $data['linkserver'];
        $episode->episode = $data['episode'];
        $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
        return redirect()->to('add-episode/' . $data['movie_id'])->with('success', 'Cập nhật');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $episode = Episode::find($id)->delete();
        return redirect()->to('episode');
    }

    public function select_movie()
    {
        $id = $_GET['id'];
        $movie = Movie::find($id);
        $output = '<option>---Chọn Tập Phim---</option>';
        if ($movie->thuocphim == 'phimbo') {
            for ($i = 1; $i <= $movie->episodes; $i++) {
                $output .= '<option value="' . $i . '">' . $i . '</option>';
            }
        } else {
            $output .= '<option value="HD">HD</option>
            <option value="FullHD">FullHD</option>
            <option value="Cam">Cam</option>
            <option value="HDCam">HDCam</option>';
        }
        echo $output;
    }
}
