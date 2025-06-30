<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Determine if username is an email or username
        $field = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        // First, check if user exists with correct credentials (ignoring status)
        $user = User::where($field, $request->username)->first();
        
        if (!$user) {
            toastr()->error('User not found. Please check your email/username.');
            return redirect()->route('website.getlogin')->withInput();
        }
        
        if (!Hash::check($request->password, $user->password)) {
            toastr()->error('Incorrect password. Please try again.');
            return redirect()->route('website.getlogin')->withInput();
        }
        
        // Check if user account is active
        if ($user->status != 1) {
            // Auto-activate customer accounts for now (temporary fix)
            if ($user->roles === 'customer') {
                $user->status = 1;
                $user->save();
                toastr()->info('Your account has been activated!');
            } else {
                toastr()->error('Your account is inactive. Please contact administrator.');
                return redirect()->route('website.getlogin')->withInput();
            }
        }
        
        // Log the user in
        Auth::login($user);
        $redirectRoute = $user->roles === 'admin' ? 'admin.dashboard.index' : 'site.home';
        toastr()->success('Login successful! Welcome back, ' . $user->name);
        return redirect()->route($redirectRoute);
    }

    public function logout()
    {
        Auth::logout();
        toastr()->warning('Logged out successfully!');
        return redirect()->route('site.home');
    }

    public function getSignup()
    {
        return view('auth.signup');
    }

    public function doSignup(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'gender' => 'required|in:0,1',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->username = $data['email']; // Consider allowing unique usernames
            $user->gender = (int) $data['gender'];
            $user->phone = $data['phone'];
            $user->address = $data['address'];
            $user->roles = 'customer';
            $user->status = 1; // Explicitly set active status
            $user->created_by = 0;
            $user->password = Hash::make($data['password']);
            $user->save();

            auth()->login($user);

            toastr()->success('Registration successful!');
            return redirect()->route('site.home');
        } catch (ValidationException $e) {
            toastr()->error('Registration failed. Please check your inputs.');
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            toastr()->error('An error occurred during registration.');
            return redirect()->back()->withInput();
        }
    }
}