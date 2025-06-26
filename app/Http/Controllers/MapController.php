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
        $map = $request->all();
        Map::create($map);
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
