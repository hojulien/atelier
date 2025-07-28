<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Map;

class MapController extends Controller
{
    public function index(Request $request)
    {
        // 1 - INITIAL QUERY - we get all maps with their like count
        $query = Map::withCount('likedByUsers');

        // 2 - GET ALL TAGS - gets all tags and filters them to be normalized and distinct. used for tag filtering.
        $tags = $query->pluck('tags')
            ->filter()
            ->flatMap(function($tag) {
                return array_map('trim', $tag);
            })
            ->map(fn($tag) => strtolower($tag))
            ->unique()->sort()->values();

        // 3 - VARIOUS FILTERS - filters by search/filter, sortby, and tags.
        if ($request->filled('tags')) {
            $selectedTags = $request->input('tags');

            $query->where(function ($q) use ($selectedTags) {
                foreach ($selectedTags as $tag) {
                    $q->where('tags', 'like', '%' . $tag . '%');
                }
            });
        }

        if ($request->filled('search') && $request->filled('filter')) {
            // retrieves search input and filter type
            $input = $request->input('search');
            $filter = $request->input('filter');

            // whitelist columns for security
            $allowedFields = ['artist', 'title', 'creator'];

            // execute "where" query depending on filter values (in_array for additional security check)
            if ($filter === "default") {
                $query->where('artist', 'like', "%{$input}%")
                    ->orWhere('title', 'like', "%{$input}%")
                    ->orWhere('creator', 'like', "%{$input}%");
            } else if (in_array($filter, $allowedFields)) {
                $query->where($filter, 'like', "%{$input}%");
            }
        }

        if ($request->filled('sortby')) {
            $sortBy = $request->input('sortby');
            $allowedFields = ['artist', 'title', 'sr', 'length', 'cs', 'hp', 'ar', 'od', 'submitDate', 'lastUpdated'];

            if (in_array($sortBy, $allowedFields)) {
                $order = $request->input('order', 'asc'); // defaults to asc if nothing provided

                // double check to prevent any other values from being tried on
                if (!in_array($order, ['asc', 'desc'])) {
                    $order = 'asc';
                }

                $query->orderBy($sortBy, $order);
            }
        }

        // 4 - GET THE QUERY - after all filters, finalizes the query
        $mapsPerPage = $request->input('maps_per_page', 10);
        $maps = $query->paginate($mapsPerPage)->appends(request()->query());

        return view('maps.index', compact('maps', 'tags'));
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
            'tags' => 'nullable|array|min:0|max:10',
            'tags.*' => 'nullable|string|distinct|max:20', // distinct means no duplicates exists within the array
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
            'tags' => 'nullable|array|min:0|max:10',
            'tags.*' => 'nullable|string|distinct|max:20',
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
