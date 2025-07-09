<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SuggestionController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suggestions = Suggestion::all();
        return view('suggestions.index', compact('suggestions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // evolution: remove after adding middleware
        $users = User::all();
        return view('suggestions.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validates all inputs individually
        $validated = $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
            'media_file' => 'required_if:type,media|file',
            'media_url' => 'required_if:type,music|url',
            'user_id' => 'required'
        ]);

        // we need to transfer "media_file" or "media_url" over to "media"
        // so $suggestion cannot be created yet until $validated is finalized.
        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $file->storeAs('images/suggestions', $filename, 'public');
            $validated['media'] = $filename;
            unset($validated['media_file']);
        }

        if ($request->hasFile('media_url')) {
            $validated['media'] = $validated['media_url'];
            unset($validated['media_url']);
        }

        Suggestion::create($validated);

        // evolution: redirect to main page?
        return redirect()->route('suggestions.index')->with('success', 'your suggestion has been submitted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $suggestion = Suggestion::findOrFail($id);
        $this->authorize('view', $suggestion);
        return view('suggestions.show', compact('suggestion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::all();
        $suggestion = Suggestion::findOrFail($id);
        return view('suggestions.edit', compact('suggestion','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // evolution: remove this feature (realistically not needed)
        // just there to test the CRUD
        $suggestion = Suggestion::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
            'media_file' => 'required_if:type,media|file',
            'media_url' => 'required_if:type,music|url',
            'user_id' => 'required'
        ]);

        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $file->storeAs('images/suggestions', $filename, 'public');
            $validated['media'] = $filename;
            if ($suggestion->media) {
                Storage::disk('public')->delete('images/suggestions/' . $suggestion->media);
            }
            unset($validated['media_file']);
        } else {
            $validated['media'] = $validated['media_url'];
            unset($validated['media_url']);
        }

        $suggestion->update($validated);
        return redirect()->route('suggestions.index')->with('success', 'suggestion updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // evolution: pass ID number in the session message
        $suggestion = Suggestion::findOrFail($id);
        $suggestion->delete();
        return redirect()->route('suggestions.index')->with('success', 'Suggestion deleted.');
    }
}
