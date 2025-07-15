<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Map;

class MapController extends Controller
{
    public function index()
    {
        // retrieves all maps with the count of users who liked each map, to display on the list
        $maps = Map::withCount('likedByUsers')->get();
        return view('maps.index', compact('maps'));
    }

    public function add()
    {
        return view('maps.add');
    }

    public function store(Request $request)
    {
        // validates all inputs individually
        $validated = $request->validate([
            'artist' => 'required|string|max:40',
            'title' => 'required|string|max:80',
            'artistUnicode' => 'nullable|string|max:25',
            'titleUnicode' => 'nullable|string|max:50',
            'rc' => 'nullable|string|max:20',
            'creator' => 'required|string|max:20',
            'sr' => 'required|decimal:0,5|min:0',
            'length' => 'required|numeric|min:0',
            'cs' => 'required|decimal:0,2|min:0',
            'hp' => 'required|decimal:0,2|min:0',
            'ar' => 'required|decimal:0,2|min:0',
            'od' => 'required|decimal:0,2|min:0',
            'setId' => 'required|numeric',
            'mapId' => 'required|numeric|unique:maps,mapId',
            'submitDate' => 'required|date_format:Y-m-d\TH:i:s',
            'lastUpdated' => 'required|date_format:Y-m-d\TH:i:s',
            'tags' => 'nullable|json',
            'background' => 'nullable|image|max:4096'
        ]);

        // changes submitDate/lastUpdated to fit the (true) correct format
        // YYYY-MM-DDTHH:MM:SS -> YYYY-MM-DD HH:MM:SS
        $validated['submitDate'] = str_replace('T', ' ', $validated['submitDate']);
        $validated['lastUpdated'] = str_replace('T', ' ', $validated['lastUpdated']);
        
        $map = Map::create($validated);

        // stores file with generated uuid name
        if ($request->hasFile('background')) {
            $file = $request->file('background');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $file->storeAs('images/maps_background', $filename, 'public');
            $map->background = $filename;
            $map->save();
        }

        return redirect()->route('maps.index')->with('success', "map {$map->mapId} added.");
    }

    public function show(string $id)
    {
        $map = Map::findOrFail($id);
        return view('maps.details', compact('map'));
    }

    public function edit(string $id)
    {
        $map = Map::findOrFail($id);
        return view('maps.edit', compact('map'));
    }

    public function update(Request $request, string $id)
    {
        $map = Map::findOrFail($id);

        $validated = $request->validate([
            'artist' => 'required|string|max:40',
            'title' => 'required|string|max:80',
            'artistUnicode' => 'nullable|string|max:25',
            'titleUnicode' => 'nullable|string|max:50',
            'rc' => 'nullable|string|max:20',
            'creator' => 'required|string|max:20',
            'sr' => 'required|decimal:0,5|min:0',
            'length' => 'required|numeric|min:0',
            'cs' => 'required|decimal:0,2|min:0',
            'hp' => 'required|decimal:0,2|min:0',
            'ar' => 'required|decimal:0,2|min:0',
            'od' => 'required|decimal:0,2|min:0',
            'setId' => 'required|numeric',
            'mapId' => 'required|numeric|unique:maps,mapId,' . $id, // passing current map's id to ignore the "unique" constraint for the map itself
            'submitDate' => 'required|date_format:Y-m-d\TH:i:s',
            'lastUpdated' => 'required|date_format:Y-m-d\TH:i:s',
            'tags' => 'nullable|json',
            'background' => 'nullable|mimes:jpg,png|max:4096'
        ]);

        $validated['submitDate'] = str_replace('T', ' ', $validated['submitDate']);
        $validated['lastUpdated'] = str_replace('T', ' ', $validated['lastUpdated']);

        if ($request->hasFile('background')) {
            $file = $request->file('background');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $file->storeAs('images/maps_background', $filename, 'public');
            $validated['background'] = $filename;
            if ($map->background) {
                Storage::disk('public')->delete('images/maps_background/' . $map->background);
            }
        }

        $map->update($validated);
        return redirect()->route('maps.index')->with('success', "map {$map->mapId} updated");
    }

    public function destroy(string $id)
    {
        $map = Map::findOrFail($id);
        $map->delete();
        return redirect()->route('maps.index')->with('success', "map {$map->mapId} deleted.");
    }
}
