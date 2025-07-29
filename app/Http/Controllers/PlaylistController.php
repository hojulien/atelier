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

    public function index(Request $request)
    {
        // initial query with relationships and sum of length (for sorting)
        $query = Playlist::query()
            ->with('user')
            ->with('maps')
            ->withSum('maps', 'length');

        // filter 1: removes empty playlists (admins) + private playlists (everyone else)
        if (Auth::check() && Auth::user()->type === 'admin') {
            $query->where('number_maps', '>', '0');
        } else {
            $query->where('visibility', 'public')
                  ->where('number_maps', '>', '0');
        }

        // filter 2: filtering
        if ($request->filled('search') && $request->filled('filter')) {
            $input = $request->input('search');

            switch ($request->input('filter')) {
                case "name":
                    $query->where('name', 'like', "%{$input}%");
                    break;
                case "creator":
                    $query->whereHas('user', function ($q) use ($input) {
                        $q->where('username', 'like', "%{$input}%");
                    });
                    break;
                // isolates the condition so that it doesn't interfere with others
                default:
                    $query->where(function ($q) use ($input) {
                        $q->where('name', 'like', "%{$input}%")
                          ->orWhereHas('user', function ($q2) use ($input) {
                                $q2->where('username', 'like', "%{$input}%");
                            });
                    });
                    break;
            }
        }

        // filter 3: sorting
        if ($request->filled('sortby')) {
            $sortBy = $request->input('sortby');
            $order = $request->input('order', 'asc'); // defaults to asc if nothing provided

            // double check to prevent any other values from being tried on
            if (!in_array($order, ['asc', 'desc'])) {
                $order = 'asc';
            }

            // for name/number of maps, sort manually
            // for creator, joins with users table and sort by usernames
            // for length, order by column created from the withSum() earlier
            switch ($sortBy) {
                case 'name':
                case 'number_maps':
                    $query->orderBy($sortBy, $order);
                    break;
                case 'creator':
                    $query->join('users', 'playlists.user_id', '=', 'users.id')
                      ->orderBy('users.username', $order)
                      ->select('playlists.*');
                      break;
                case 'length':
                    $query->orderBy('maps_sum_length', $order);
                    break;
            }
        }
        
        $playlistsPerPage = $request->input('playlists_per_page', 10);
        $playlists = $query->paginate($playlistsPerPage)->appends(request()->query());
        
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
        $validated['number_maps'] = 0;
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
        $playlist->number_maps = count($mapsId);
        $playlist->save();

        return redirect()->route('playlists.show', $playlist->id)->with('success', 'playlist updated.');
    }

    public function show(Request $request, string $id)
    {
        $playlist = Playlist::findOrFail($id);
        $mapsPerPage = $request->input('maps_per_page', 10);

        $maps = $playlist->maps()
            ->withCount('likedByUsers')
            ->paginate($mapsPerPage)
            ->appends(request()->query());

        return view('playlists.show', compact('playlist', 'maps'));
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
