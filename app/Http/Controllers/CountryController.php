<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Carbon\Carbon;
use Toastr;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Country::orderBy('position', 'ASC')->get();
        return view('admincp.country.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.country.form');
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
                'title' => 'required|unique:countries|max:100',
                'slug' => 'required|unique:countries|max:100',
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

        $country = new Country();
        $country->title = $data['title'];
        $country->slug = $data['slug'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $country->save();
        toastr()->success("Thêm thành công quốc gia: $country->title");
        return redirect()->route('country.index');
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
        $country = Country::find($id);
        $list = Country::orderBy('position', 'ASC')->get();
        return view('admincp.country.form', compact('list', 'country'));
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
    
        $country = Country::find($id);
    
        if ($country->title != $data['title']) {
            Toastr::success('Thay đổi tiêu đề quốc gia thành ' . $data['title']);
        }
    
        if ($country->slug != $data['slug']) {
            Toastr::success('Thay đổi slug quốc gia thành ' . $data['slug']);
        }
    
        if ($country->description != $data['description']) {
            Toastr::success('Thay đổi mô tả quốc gia thành ' . $data['description']);
        }
    
        if ($country->status != $data['status']) {
            Toastr::success('Thay đổi trạng thái quốc gia thành ' . $data['status']);
        }
    
        $country->title = $data['title'];
        $country->slug = $data['slug'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $country->save();
    
        return redirect()->route('country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        if ($country) {
            $countryName = $country->title;
            $country->delete();
            toastr()->warning("Xóa thành công quốc gia: $countryName");
        } else {
            toastr()->error('Không tìm thấy quốc gia để xóa');
        }
        return redirect()->back();
    }
    

    public function resorting_country(Request $request)
    {
        $data = $request->all();

        foreach ($data['array_id'] as $key => $value) {
            $country = Country::find($value);
            $country->position = $key;
            $country->save();
        }
    }
}
