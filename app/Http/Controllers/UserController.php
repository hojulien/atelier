<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
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
        $user = User::findOrFail($id);
        // only authorizes access to admins and users editing their own profile
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);

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

        // if new file, adds it and delete old one (if it exists and is NOT the default file)
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $file->storeAs('images/avatars', $filename, 'public');
            $validated['avatar'] = $filename;
            if ($user->avatar && $user->avatar !== 'default.png') {
                Storage::disk('public')->delete('images/avatars/' . $user->avatar);
            }
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $file->storeAs('images/banners', $filename, 'public');
            $validated['banner'] = $filename;
            if ($user->banner && $user->avatar !== 'default.png') {
                Storage::disk('public')->delete('images/banners/' . $user->banner);
            }
        }

        $user->update($validated);
        return redirect()->route('users.show', $user->id)->with('success', 'account informations updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        
        $user->delete();
        return redirect()->route('users.index')->with('success', 'account successfully deleted.');
    }
}
