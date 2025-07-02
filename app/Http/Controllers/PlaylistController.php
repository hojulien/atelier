<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\User;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $playlists = Playlist::all();
        return view('playlists.index', compact('playlists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // evolution: remove after adding middleware
        $users = User::all();
        return view('playlists.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // evolution: redirect towards adding maps list (passing id of the newly create playlist)
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'user_id' => 'required'
        ]);

        // evolution: set type in create form depending on user type (after logged in)
        $validated['number_levels'] = 0;
        $validated['type'] = 'user';

        Playlist::create($validated);
        return redirect()->route('playlists.index')->with('success', 'your playlist has been submitted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $playlist = Playlist::findOrFail($id);
        return view('playlists.show', compact('playlist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $playlist = Playlist::findOrFail($id);
        return view('playlists.edit', compact('playlist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->update($request->all());
        return redirect()->route('playlists.index')->with('success', 'Playlist updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->delete();
        return redirect()->route('playlists.index')->with('success', 'Playlist deleted.');
    }
}
