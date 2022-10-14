<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function post_login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $checkUserByemail = User::where('email', $email)->take(1)->first();
        if ($checkUserByemail && Hash::check($request->password, $checkUserByemail->password)) {
            Auth::login($checkUserByemail);
            return redirect()->route('websiteProduct')->with('success', 'Đăng nhập thành công!');;
        } else {
            Session::flash('error_login', 'Thông tin tài khoản hoặc mật khẩu không chính xác');
            return redirect()->back();
        }
    }
}
