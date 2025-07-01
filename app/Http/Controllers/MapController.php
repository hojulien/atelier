<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maps = Map::all();
        return view('maps.index', compact('maps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // evolution: renommer en "add" ?
        return view('maps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // evolution: specify mapID in the session message

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

        // after creating the entry, grabs the id in order to create the file name ({id}.{extension})
        if ($request->hasFile('background')) {
            $file = $request->file('background');
            $extension = $file->getClientOriginalExtension();
            $filename = $map->id . '.' . $extension;
            $file->storeAs('images/maps_background', $filename, 'public');
            $map->background = $filename;
            $map->save();
        }

        return redirect()->route('maps.index')->with('success', 'Map added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // evolution: url name "details" ?
        $map = Map::findOrFail($id);
        return view('maps.show', compact('map'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $map = Map::findOrFail($id);
        return view('maps.edit', compact('map'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // evolution: specify mapID in the session message
        $map = Map::findOrFail($id);
        $map->update($request->all());
        return redirect()->route('maps.index')->with('success', 'Map updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // evolution: specify mapID in the session message
        $map = Map::findOrFail($id);
        $map->delete();
        return redirect()->route('maps.index')->with('success', 'Map deleted');
    }
}
