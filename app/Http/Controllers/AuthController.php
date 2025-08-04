<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // login view (GET)
    public function login() {
        return view('auth.login');
    }

    // login validation (POST)
    public function loginAction(Request $request) {

        $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        // check if credentials match
        $userIsValid = Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ]);

        if ($userIsValid) {
            // regenerates session id to prevent session fixation
            $request->session()->regenerate();

            // redirects to different pages depending on user type
            if (Auth::user()->type === "admin") {
                return redirect()->intended(route('dashboard')); // evolution: update to dashboard page
            } else {
                return redirect()->intended(route('maps.index')); // evolution: update to home page
            }
        }

        return back()->withErrors([
            'username' => 'invalid username or password.',
        ])->onlyInput('username');
    }

    // logs out the user, then removes all data in the session and regenerates token instantly
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('login');
    }

    // register view (get)
    public function register() {
        return view('auth.register');
    }

    // register validation (post)
    public function registerAction(Request $request) {
        // validates all inputs individually with rules (array 1) and custom error messages (array 2)
        $validated = $request->validate(
        [
            'username' => 'required|string|min:4|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z\d]).{8,}$/',
            'avatar' => 'nullable|mimes:jpg,png|dimensions:max_width=500,max_height=500|max:2048',
            'banner' => 'nullable|mimes:jpg,png|dimensions:min_width=1200,min_height=500|max:8192'
        ],
        [
            'required' => ':attribute is required.',
            'unique' => ':attribute is already used.',
            'confirmed' => 'both passwords must match.',
            'mimes' => 'file must be an image.',

            'username.min' => 'username must be at least 4 characters.',
            'password.regex' => 'password must be at least 8 characters and contain: 1 lowercase letter, 1 uppercase letter, 1 number and 1 special character.',
            'avatar.dimensions' => 'avatar must not exceed 500x500.',
            'avatar.max' => 'avatar must not be larger than 2mb.',
            'banner.dimensions' => 'banner must be at least 1200x500.',
            'banner.max' => 'avatar must not be larger than 8mb.'
        ]);

        // sets role manually
        $validated['type'] = 'user';

        $user = User::create($validated);

        // evolution: factorize this code later (traits?)
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $file->storeAs('images/avatars', $filename, 'public');
            $user->avatar = $filename;
            $user->save();
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $file->storeAs('images/banners', $filename, 'public');
            $user->banner = $filename;
            $user->save();
        }
        
        return to_route('login');
    }
}
