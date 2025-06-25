<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller {
    public function getlogin() {
        return view("login");
    }

    public function dologin(Request $request) {
        $credentials = [
            'password' => $request->password,
            'status'=>1
        ];

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->username;
        } else {
            $credentials['username'] = $request->username;
        }

        if (Auth::attempt($credentials)) { 
            $user = Auth::user();
            if ($user->roles == "admin") {
                toastr()->success('Login successfully!');
                return redirect()->route('admin.dashboard.index');
            }
            toastr()->success('Login successfully!');
            return redirect()->route('site.home');
        } else {
            toastr()->error('Login unsuccessfully!');
            return redirect()->route('website.getlogin');
        }
    }

    public function logout() {
        Auth::logout();
        toastr()->warning('Logout successfully!');
        return redirect()->route('site.home');
    }

    public function getSignup()
    {
        return view('auth.signup');
    }

    public function doSignup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|in:1,0',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new \App\Models\User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('email');
        $user->gender = (int)$request->input('gender');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->roles = 'customer';
        $user->created_by = 0;
        $user->password = \Illuminate\Support\Facades\Hash::make($request->input('password'));
        $user->save();

        auth()->login($user);

        return redirect()->route('site.home')->with('success', 'Đăng ký thành công!');
    }
}