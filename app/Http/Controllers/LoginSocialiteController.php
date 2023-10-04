<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\Customer;
use App\Models\Info;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;
use Carbon\Carbon;
class LoginSocialiteController extends Controller
{
    //login customers
    public function redirectToLogin(){
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = '';
        return view('pages.loginCustomers.login', compact('meta_title', 'meta_description', 'meta_image'));
    }

    //register customers
    public function redirectToRegister(){
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = '';
        return view('pages.loginCustomers.register', compact('meta_title', 'meta_description', 'meta_image'));
    }

    public function redirectToForgotPassword(){
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = '';
        return view('pages.loginCustomers.forgotPassword', compact('meta_title', 'meta_description', 'meta_image'));
    }

    public function redirectToResetPassword(Request $request, $email, $token){
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = '';
        $request->token;
        $request->email;
        return view('pages.loginCustomers.resetPassword', compact('meta_title', 'meta_description', 'meta_image', 'token', 'email'));
    }

    public function verifyEmail(Request $request, $email){
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = '';
        $request->email;
        return view('pages.loginCustomers.VerifyEmail', compact('meta_title', 'meta_description', 'meta_image', 'email'));
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'check-password' => 'required|same:password',
            'token' => 'required',
        ],
        [
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'check-password.required' => 'Vui lòng nhập lại mật khẩu',
            'check-password.same' => 'Mật khẩu nhập lại không khớp',
        ]);
        
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $customer = Customer::where('email', $request->email)->first();
    
        if (!$customer) {
            return redirect()->back()->withErrors(['email' => 'Không tìm thấy người dùng với địa chỉ email này.']);
        }
    
        if ($customer->token !== $request->token) {
            return redirect()->back()->withErrors(['token' => 'Lỗi vui lòng làm lại.']);
        }
        
        if ($customer->expires_at < $now) {
            return redirect()->back()->withErrors(['token' => 'Liên kết này đã hết hạn vui lòng thực hiện lại từng bước quên mật khẩu.']);
        }

        $customer->update([
            'password' => bcrypt($request->password),
            'token' => null,
        ]);
    
        Auth::guard('customer')->login($customer);
    
        return redirect('/')->with('success', 'Đổi mật khẩu thành công.');
    }

    public function sendResetLinkEmail(Request $request){
        $request->validate([
            'email' => 'required|email|exists:customers,email',
        ],
        [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.exists' => 'Không tìm thấy người dùng với địa chỉ email này.',
        ]);
        
        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return back()->withErrors(['email' => 'Không tìm thấy người dùng với địa chỉ email này.']);
        }
        $name = $customer->name;
        $token = Str::random(64);
        $expires_at = Carbon::now('Asia/Ho_Chi_Minh')->addHour();
        $customer->update(['token' => $token, 'expires_at' => $expires_at]);
        $resetLink = route('redirectToResetPassword', ['token' => $token, 'email' => $customer->email]);
        Mail::to($customer->email)->send(new ResetPasswordMail($resetLink, $name));

        return back()->with('status', 'Email đã được gửi thành công. Vui lòng kiểm tra hộp thư đến của bạn.');
    }

    public function CheckLoginCustomers(Request $request){
        try {
            $email = $request->input('email');
            $password = $request->input('password');
    
            $customer = Customer::where('email', $email)->first();
    
            if (!$customer) {
                return back()->withErrors(['email' => 'Email không tồn tại']);
            }
    
            if (!$customer->verified) {
                return redirect()->route('verifyEmail', ['email' => $email])->with('status', 'Tài khoản của bạn chưa được xác thực vui lòng click vào dưới để gửi lại mã xác thực');
            }

            if ($customer->locked) {
                return back()->withErrors(['email' => 'Sorry!! Tài khoản của bạn đã bị khóa. Vui lòng liên hệ admin để biết thêm chi tiết']);
            }
    
            if (Auth::guard('customer')->attempt(['email' => $email, 'password' => $password], $request->input('remember'))) {
                return redirect()->intended('/');
            } else {
                return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']);
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }
    

    public function RegisterCustomers(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6',
            'check-password' => 'required|same:password',
        ], 
        [
            'name.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'check-password.required' => 'Vui lòng nhập lại mật khẩu',
            'check-password.same' => 'Mật khẩu nhập lại không khớp',
        ]);

        $customer = new Customer;
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->password = bcrypt($request->input('password'));
        $customer->verification_code = Str::random(4);
        $customer->verified = false;
        $customer->locked = false;
        $customer->created_at = Carbon::now('Asia/Ho_Chi_Minh')->addHour();
        $customer->save();

        $passCode = $customer->verification_code;
        $email = $customer->email;
        Mail::to($customer->email)->send(new VerifyEmail($passCode, $email));
        return redirect()->route('verifyEmail',['email' => $customer->email])->with('status', 'Vui lòng xác nhận code trong email.');
    }

    public function checkCodeLogin(Request $request){
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $verification_code = $request->input('verification_code');
        $email = $request->input('email');
    
        $customer = Customer::where('email', $email)->where('verification_code', $verification_code)->first();
    
        if ($customer) {
            if ($customer->created_at < $now) {
                return redirect()->back()->withErrors(['verification_code' => 'Mã đã hết hạn, vui lòng click vào đây để gửi lại mã xác minh.']);
            }
    
            if ($verification_code === $customer->verification_code) {
                $customer->verified = true;
                $customer->save();
    
                Auth::guard('customer')->login($customer);
    
                return redirect('/');
            }
        }
    
        return redirect()->back()->with('status', 'Lỗi nhập sai mã xác minh, vui lòng nhập lại.');
    }
    
    public function resendCode(Request $request, $email){
        $email = $request->email;
        $customer = Customer::where('email', $email)->first();
        if (!$customer) {
            return redirect()->back()->with('status', 'Không tìm thấy tài khoản với email này.');
        }
    
        $passCode = Str::random(4);
        $customer->verification_code = $passCode;
        $customer->created_at = Carbon::now('Asia/Ho_Chi_Minh')->addHour();
        $customer->save();
        
        // $email = $customer->email;
        Mail::to($customer->email)->send(new VerifyEmail($passCode, $email));
    
        return redirect()->route('verifyEmail',['email' => $customer->email])->with('status', 'Đã gửi lại mã xác minh, vui lòng xác nhận mã trong email.');
    }
    
    
    //login to google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $customer = Customer::where('google_id', $googleUser->id)->first();

            if ($customer) {
                Auth::guard('customer')->login($customer);
                return redirect()->intended('/');
            } else {
                $newCustomer = Customer::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('123456dummy'),
                ]);

                Auth::guard('customer')->login($newCustomer);
            }

            return redirect()->intended('/');
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    //login to facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
        
            $facebookUser = Socialite::driver('facebook')->user();

            $customerFacebook = Customer::where('facebook_id', $facebookUser->id)->first();

            if($customerFacebook){
                Auth::guard('customer')->login($customerFacebook);
                return redirect()->intended('/');
            }else{
                $newUser = Customer::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'facebook_id'=> $facebookUser->id,
                    'password' => encrypt('123456dummy')
                ]);
        
                Auth::guard('customer')->login($customerFacebook);
            }

            return redirect()->intended('/');
            
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function logout(){
        Auth::guard('customer')->logout();
        return redirect('/');
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
}
