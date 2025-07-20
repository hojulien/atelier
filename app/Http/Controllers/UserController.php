<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Map;
use IlluminateSupportCarbon;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $mapsPerPage = $request->input('maps_per_page', 10);
        $playlistsPerPage = $request->input('playlists_per_page', 10);

        $likedMaps = $user->likedMaps()
            ->withCount('likedByUsers')
            ->paginate($mapsPerPage, ['*'], 'maps_page')
            ->appends($request->except('maps_page'));

        $playlists = $user->playlists()
            ->withCount('maps')
            ->paginate($playlistsPerPage, ['*'], 'playlists_page')
            ->appends($request->except('playlists_page'));
             
        return view('users.profile', compact('user', 'likedMaps', 'playlists'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        // only authorizes access to admins and users editing their own profile
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        // password is nullable so we can keep old one if null
        $validated = $request->validate(
        [
            'username' => 'required|string|min:4|max:20|unique:users,username,' . $id, // passing user's id to ignore the "unique" constraint for the user itself
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z\d]).{8,}$/',
            'avatar' => 'nullable|mimes:jpg,png|dimensions:max_width=500,max_height=500|max:2048',
            'banner' => 'nullable|mimes:jpg,png|dimensions:min_width=1200,min_height=500|max:8192'
        ],
        [
            'required' => ':attribute is required.',
            'unique' => ':attribute is already used.',
            'confirmed' => 'both passwords must match.',
            'mimes' => 'file must be an image.',

            'username.min' => 'username must be at least 4 characters.',
            'username.max' => 'username must not be longer than 20 characters.',
            'password.regex' => 'password must be at least 8 characters and contain: 1 lowercase letter, 1 uppercase letter, 1 number and 1 special character.',
            'avatar.dimensions' => 'avatar must not exceed 500x500.',
            'avatar.max' => 'avatar must not be larger than 2mb.',
            'banner.dimensions' => 'banner must be at least 1200x500.',
            'banner.max' => 'avatar must not be larger than 8mb.'
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
        return redirect()->route('users.profile', $user->id)->with('success', 'account informations updated.');
    }

    public function destroy(string $id)
    {
        // evolution: request password + confirm for deletion
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        
        $user->delete();
        return redirect()->route('users.index')->with('success', 'account successfully deleted.');
    }

    public function like (string $mapId)
    {
        Map::findOrFail($mapId);
        $user = Auth::user();

        // attach map id to user for likes pivot table
        $user->likedMaps()->attach($mapId);
        return redirect()->back();
    }

    public function unlike (string $mapId)
    {
        Map::findOrFail($mapId);
        $user = Auth::user();

        // detach map id from user for likes pivot table
        $user->likedMaps()->detach($mapId);
        return redirect()->back();
    }
}
