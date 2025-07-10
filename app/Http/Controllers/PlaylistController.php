<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\Playlist;
use App\Models\User;

class PlaylistController extends Controller
{
    use AuthorizesRequests;

    // set rules and messages - protected means it can ONLY be accessed by its own class
    protected function rules() {
        $rules = [
            'name' => 'required|string|min:5|max:50',
            'description' => 'nullable|string',
            'visibility' => 'required'
        ];

        return $rules;
    }

    protected function messages() {
        $messages = [
            'name.required' => 'playlist name is required.',
            'name.min' => 'playlist name must be at least 5 characters.',
            'name.max' => 'playlist name must be under 50 characters.',
        ];

        return $messages;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // returns all playlists for admins, else returns only public playlists
        if (Auth::check() && Auth::user()->type === 'admin') {
            $playlists = Playlist::all();
        } else {
            $playlists = Playlist::where('visibility', 'public')->get();
        }
        
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
        $validated = $request->validate($this->rules(), $this->messages());

        // manual entry
        $validated['user_id'] = Auth::user()->id;
        $validated['type'] = Auth::user()->type;
        $validated['number_levels'] = 0;

        Playlist::create($validated);

        // evolution: redirect towards adding maps list (passing id of the newly create playlist)
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
        $users = User::all();
        $playlist = Playlist::findOrFail($id);
        $this->authorize('update', $playlist);
        
        return view('playlists.edit', compact('playlist','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $this->authorize('update', $playlist);

        $validated = $request->validate($this->rules(), $this->messages());

        $playlist->update($validated);
        return redirect()->route('playlists.index')->with('success', 'playlist updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $this->authorize('update', $playlist);

        $playlist->delete();
        return redirect()->route('playlists.index')->with('success', 'playlist deleted.');
    }
}
