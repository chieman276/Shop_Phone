<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function post_register(RegisterRequest $request)
    {
        $register = new User();
        $register->userName = $request->userName;
        $register->email = $request->email;
        $register->phone = $request->phone;
        $register->birthday = $request->birthday;
        $register->password = Hash::make($request->password);
        try {
        $register->save();
            return redirect()->route('login')->with('success', 'Đăng ký thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('register')->with('error', 'Đăng ký không thành công');
        }
    }
}
