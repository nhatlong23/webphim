<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Genre::all();
        return view('admincp.genre.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.genre.form');
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
                'title' => 'required|unique:genres|max:100',
                'slug' => 'required|unique:genres|max:100',
                'description' => 'required|max:255',
                'status' => 'required',
            ],
            [
                'title.required' => 'Vui lòng nhập tiêu đề',
                'title.unique' => 'Tiêu đề đã tồn tại',
                'title.max' => 'Tiêu đề không được quá 100 ký tự',
                'slug.required' => 'Vui lòng nhập slug',
                'slug.unique' => 'Slug đã tồn tại',
                'slug.max' => 'Slug không được quá 100 ký tự',
                'description.required' => 'Vui lòng nhập mô tả',
                'description.max' => 'Mô tả không được quá 255 ký tự',
                'status.required' => 'Vui lòng chọn trạng thái',
            ]
        );

        $genre = new Genre();
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $genre->save();
        toastr()->success("Thêm thành công thể loại: $genre->title");
        return redirect()->route('genre.index');
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
        $genre = Genre::find($id);
        $list = Genre::all();
        return view('admincp.genre.form', compact('list', 'genre'));
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
        $data = $request->validate([
            'title' => 'required|max:100',
            'slug' => 'required|max:100',
            'description' => 'required|max:255',
            'status' => 'required',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.max' => 'Tiêu đề không được quá 100 ký tự',
            'slug.required' => 'Vui lòng nhập slug',
            'slug.max' => 'Slug không được quá 100 ký tự',
            'description.required' => 'Vui lòng nhập mô tả',
            'description.max' => 'Mô tả không được quá 255 ký tự',
            'status.required' => 'Vui lòng chọn trạng thái',
        ]);

        $genre = Genre::find($id);

        if ($genre->title != $data['title']) {
            toastr()->success('Thay đổi tiêu đề thể loại thành ' . $data['title']);
        }

        if ($genre->slug != $data['slug']) {
            toastr()->success('Thay đổi slug thể loại thành ' . $data['slug']);
        }

        if ($genre->description != $data['description']) {
            toastr()->success('Thay đổi mô tả thể loại thành ' . $data['description']);
        }

        if ($genre->status != $data['status']) {
            $statusText = $data['status'] == 1 ? 'hiển thị' : 'không hiển thị';
            toastr()->success('Thay đổi trạng thái thể loại thành ' . $statusText);
        }

        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $genre->save();

        return redirect()->route('genre.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genre::find($id);
        if ($genre) {
            $genreName = $genre->title;
            $genre->delete();
            toastr()->warning("Xóa thành công thể loại: $genreName");
        } else {
            toastr()->error('Không tìm thấy thể loại để xóa');
        }
        return redirect()->route('genre.index');
    }

    public function resorting_genre(Request $request)
    {
        $data = $request->all();

        foreach ($data['array_id'] as $key => $value) {
            $genre = Genre::find($value);
            $genre->position = $key;
            $genre->save();
        }
    }
}
