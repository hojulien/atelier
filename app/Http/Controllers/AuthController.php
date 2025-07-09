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
            'password' => 'required|min:4'
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
                return redirect()->intended(route('users.index')); // evolution: update to dashboard page
            } else {
                return redirect()->intended(route('maps.index')); // evolution: update to home page
            }
        }

        return back()->withErrors([
            'username' => 'invalid username or password.'
        ])->onlyInput('username');
    }

    public function logout() {
        Auth::logout();
        return to_route('login');
    }

    // register view (get)
    public function register() {
        return view('auth.register');
    }

    // register validation (post)
    public function registerAction(Request $request) {
        // validates all inputs individually
        $validated = $request->validate([
            'username' => 'required|unique|string',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:4',
            'avatar' => 'nullable|image|dimensions:max_width=500,max_height=500|max:2048',
            'banner' => 'nullable|image|dimensions:min_width=1200,min_height=500|max:8192'
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
