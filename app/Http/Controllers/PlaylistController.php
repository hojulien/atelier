<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\Playlist;
use App\Models\Map;
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

    public function create()
    {
        return view('playlists.create');
    }

    public function store(Request $request)
    {
        // validates with set of rules/messages from above
        $validated = $request->validate($this->rules(), $this->messages());

        // manual entry
        $validated['user_id'] = Auth::user()->id;
        $validated['type'] = Auth::user()->type;
        $validated['number_levels'] = 0;
        $playlist = Playlist::create($validated);

        return redirect()->route('playlists.show', $playlist->id)->with('success', 'your playlist has been created.');
    }

    // add maps to playlist (get)
    public function addMaps(string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $this->authorize('update', $playlist); // limit permissions to playlist owner and admins only
        $maps = Map::withCount('likedByUsers')->get();

        // pluck() retrieves all the maps id linked to the playlist, for listing
        $existingMaps = $playlist->maps->pluck('id')->all();

        return view('playlists.addMaps', compact('playlist', 'maps', 'existingMaps'));
    }

    // add maps to playlist (post)
    public function updateMaps(Request $request, string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $this->authorize('update', $playlist);
        
        // retrieves the map_id array and syncs it with the playlist
        $mapsId = $request->input('map_id');
        $playlist->maps()->sync($mapsId);

        // updates maps count
        $playlist->number_levels = count($mapsId);
        $playlist->save();

        return redirect()->route('playlists.show', $playlist->id)->with('success', 'playlist updated.');
    }

    public function show(string $id)
    {
        // retrieves the playlist, and for the maps it contains, retrieve the total like count
        $playlist = Playlist::with(['maps' => function ($query) {
            $query->withCount('likedByUsers');
        }])->findOrFail($id);

        return view('playlists.show', compact('playlist'));
    }

    public function edit(string $id)
    {
        $users = User::all();
        $playlist = Playlist::findOrFail($id);
        $this->authorize('update', $playlist);
        
        return view('playlists.edit', compact('playlist','users'));
    }

    public function update(Request $request, string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $this->authorize('update', $playlist);

        $validated = $request->validate($this->rules(), $this->messages());

        $playlist->update($validated);
        return redirect()->route('playlists.index')->with('success', 'playlist updated.');
    }

    public function destroy(string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $this->authorize('update', $playlist);

        $playlist->delete();
        return redirect()->route('playlists.index')->with('success', 'playlist deleted.');
    }
}
