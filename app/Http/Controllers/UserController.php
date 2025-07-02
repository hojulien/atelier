<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // evolution: change to "create account"
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validates all inputs individually
        $validated = $request->validate([
            'username' => 'required|string',
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

        // evolution: remove session message later
        return redirect()->route('users.index')->with('success', 'account created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // evolution: change to "view profile"
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // evolution: make only the own user and admin access to edit permissions
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // evolution: redirect to user's own profile after changes
        $user = User::findOrFail($id);

        // validates all inputs individually
        // password is nullable so we can keep old one if null
        $validated = $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|confirmed|min:4',
            'avatar' => 'nullable|image|dimensions:max_width=500,max_height=500|max:2048',
            'banner' => 'nullable|image|dimensions:min_width=1200,min_height=500|max:8192'
        ]);
        
        // if field is empty, keeps old hashed password
        if (empty($validated['password'])) {
            $validated['password'] = $user->password;
        }

        // if new file, adds it and delete old one (if it exists)
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $file->storeAs('images/avatars', $filename, 'public');
            $validated['avatar'] = $filename;
            if ($user->avatar) {
                Storage::disk('public')->delete('images/avatars/' . $user->avatar);
            }
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $file->storeAs('images/banners', $filename, 'public');
            $validated['banner'] = $filename;
            if ($user->banner) {
                Storage::disk('public')->delete('images/banners/' . $user->banner);
            }
        }

        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'account informations updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // admin only
        // evolution: make an user be able to delete their own account and redirect to login?
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Account successfully deleted.');
    }
}
