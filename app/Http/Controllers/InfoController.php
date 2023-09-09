<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InfoController extends Controller
{
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
        $info = Info::find(1);
        return view('admincp.info.form', compact('info'));
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
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit(Info $info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'contact' => 'required',
                'terms_of_use' => 'required',
                'privacy_policy' => 'required',
                'copyright_claims' => 'required',
                'about_us' => 'required',
                'hinhanh' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            ],
            [
                'title.required' => 'Vui lòng nhập tiêu đề',
                'title.unique' => 'Tiêu đề đã tồn tại',
                'title.max' => 'Tiêu đề không được quá 255 ký tự',
                'description.required' => 'Vui lòng nhập mô tả',
                'contact.required' => 'Vui lòng nhập thông tin liên hệ',
                'terms_of_use.required' => 'Vui lòng nhập điều khoản sử dụng',
                'privacy_policy.required' => 'Vui lòng nhập chính sách bảo mật',
                'about_us.required' => 'Vui lòng nhập thông tin về chúng tôi',
                'hinhanh.image' => 'Hình ảnh không đúng định dạng',
                'hinhanh.mimes' => 'Hình ảnh phải là đuôi jpg,png,jpeg,gif,svg',
                'hinhanh.dimensions' => 'Hình ảnh phải có kích thước tối thiểu 100x100 và tối đa 2000x2000',
                'hinhanh.max' => 'Hình ảnh không được quá 2MB',
                'hinhanh.min' => 'Hình ảnh không được nhỏ hơn 100KB',
                'hinhanh.required' => 'Hình ảnh là bắt buộc',
                'description.max' => 'Mô tả không được quá 255 ký tự',
            ]
        );
        $info = Info::find($id);
        $info->title = $data['title'];
        $info->description = $data['description'];
        $info->contact = $data['contact'];
        $info->terms_of_use = $data['terms_of_use'];
        $info->privacy_policy = $data['privacy_policy'];
        $info->copyright_claims = $data['copyright_claims'];
        $info->about_us = $data['about_us'];
        $info->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->file('image');


        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/logo/', $new_image);
            $info->logo = $new_image;
        }
        $info->save();
        toastr()->success('thành công', 'Cập nhật thông tin website thành công!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Info $info)
    {
        //
    }
}
