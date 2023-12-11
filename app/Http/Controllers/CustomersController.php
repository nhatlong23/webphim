<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Sessions;
use App\Models\Customer;
use App\Models\Movie;
use Carbon\Carbon;
use App\Models\Info;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    public function toggleCustomerLock(Request $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại.');
        }

        $customer->locked = !$customer->locked;
        $customer->save();

        $action = $customer->locked ? 'KHÓA' : 'MỞ KHÓA';
        $message = 'Tài khoản của người dùng đã được "' . $action . '" thành công.';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_customers = Customer::orderBy('id', 'DESC')->get();
        return view('admincp.customers.index', compact('all_customers'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profile_admin()
    {
        $admin = User::find(Auth::id());
        $all_admin = User::where('roles', '!=', 0)->orderBy('id', 'DESC')->get();
        return view('admincp.profile.profile_admin', compact('admin', 'all_admin'));
    }

    public function update_role_admin(Request $request)
    {
        $data = $request->all();
        $admin = User::find($data['admin_id']);
        $admin->roles = $data['roles'];
        $admin->save();
        return redirect()->back()->with('success', 'Cập nhật quyền thành công.');
    }

    public function update_locked_admin(Request $request)
    {
        $data = $request->all();
        $admin = User::find($data['admin_id']);
        $admin->locked = $data['locked'];
        $admin->save();
        return redirect()->back()->with('success', 'Cập nhật khóa thành công.');
    }

    public function delete_admin(Request $request)
    {
        $admin = User::find($request->id);
    
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin not found.');
        }
    
        $admin->delete();
        return redirect()->back()->with('success', 'Xóa admin thành công.');
    }

    public function update_profile_admin(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone_number' => 'required',
                'address' => 'required',
            ],
            [
                'name.required' => 'Vui lòng nhập tên.',
                'phone_number.required' => 'Vui lòng nhập số điện thoại.',
                'address.required' => 'Vui lòng nhập địa chỉ.',
            ]
        );
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file_name = $file->getClientOriginalName();
            $file->move('uploads/avatar', $file_name);
            $user->avatar = $file_name;
        }
        $user->save();
        return redirect()->back()->with('success', 'Cập nhật thông tin admin thành công.');
    }
}
