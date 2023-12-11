<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Category::orderBy('position', 'ASC')->get();
        return view('admincp.category.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.category.form');
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
                'title' => 'required|unique:categories|max:100',
                'slug' => 'required|unique:categories|max:100',
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

        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $category->save();
        toastr()->success("Thêm thành công danh mục: $category->title");
        return redirect()->route('category.index');
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
        $list = Category::orderBy('position', 'ASC')->get();
        $category = Category::find($id);
        return view('admincp.category.form', compact('list', 'category'));
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

        $category = Category::find($id);

        if ($category->title != $data['title']) {
            toastr()->success('Thay đổi tiêu đề danh mục thành ' . $data['title']);
        }

        if ($category->slug != $data['slug']) {
            toastr()->success('Thay đổi slug danh mục thành ' . $data['slug']);
        }

        if ($category->description != $data['description']) {
            toastr()->success('Thay đổi mô tả danh mục thành ' . $data['description']);
        }

        if ($category->status != $data['status']) {
            $statusText = $data['status'] == 1 ? 'hiển thị' : 'không hiển thị';
            toastr()->success('Thay đổi trạng thái danh mục thành ' . $statusText);
        }

        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $categoryName = $category->title;
            $category->delete();
            toastr()->warning("Xóa thành công danh mục: $categoryName");
        } else {
            toastr()->error('Không tìm thấy danh mục để xóa');
        }
        return redirect()->route('category.index');
    }

    public function resorting_category(Request $request)
    {
        $data = $request->all();

        foreach ($data['array_id'] as $key => $value) {
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
        }
    }
}
