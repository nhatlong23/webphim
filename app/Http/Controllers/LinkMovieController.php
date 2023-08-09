<?php

namespace App\Http\Controllers;

use App\Models\LinkMovie;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LinkMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $linkmovie = LinkMovie::orderBy('id', 'DESC')->get();
        return view('admincp.linkmovie.index', compact('linkmovie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.linkmovie.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => 'required|unique:linkmovie|max:255',
                'description' => 'required|max:255',
                'status' => 'required',
            ],
            [
                'title.required' => 'Vui lòng nhập tiêu đề',
                'title.unique' => 'Tiêu đề đã tồn tại',
                'title.max' => 'Tiêu đề không được quá 255 ký tự',
                'description.required' => 'Vui lòng nhập mô tả',
                'description.max' => 'Mô tả không được quá 255 ký tự',
                'status.required' => 'Vui lòng chọn trạng thái',
            ]
        );

        $linkmovie = new LinkMovie();
        $linkmovie->title = $data['title'];
        $linkmovie->description = $data['description'];
        $linkmovie->status = $data['status'];
        $linkmovie->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $linkmovie->save();

        toastr()->success('thành công', 'Thêm dữ liệu danh mục thành công!');
        return redirect()->route('linkmovie.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LinkMovie  $linkMovie
     * @return \Illuminate\Http\Response
     */
    public function show(LinkMovie $linkMovie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LinkMovie  $linkMovie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $linkmovie = LinkMovie::find($id);
        return view('admincp.linkmovie.form', compact('linkmovie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LinkMovie  $linkMovie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'title' => 'required:linkmovie|max:255',
                'description' => 'required|max:255',
                'status' => 'required',
            ],
            [
                'title.required' => 'Vui lòng nhập tiêu đề',
                'title.max' => 'Tiêu đề không được quá 255 ký tự',
                'description.required' => 'Vui lòng nhập mô tả',
                'description.max' => 'Mô tả không được quá 255 ký tự',
                'status.required' => 'Vui lòng chọn trạng thái',
            ]
        );

        $linkmovie = LinkMovie::find($id);
        $linkmovie->title = $data['title'];
        $linkmovie->description = $data['description'];
        $linkmovie->status = $data['status'];
        $linkmovie->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $linkmovie->save();

        toastr()->success('thành công', 'Cập nhật link phim thành công!');
        return redirect()->route('linkmovie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LinkMovie  $linkMovie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LinkMovie::find($id)->delete();
        toastr()->warning('Xóa thành công');
        return redirect()->back();
    }
}
