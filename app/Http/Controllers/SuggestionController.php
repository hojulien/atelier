<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\User;

class SuggestionController extends Controller
{
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
            'media' => 'required',
            'user_id' => 'required'
        ]);

        $suggestion = Suggestion::create($validated);

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $file->storeAs('images/suggestions', $filename, 'public');
            $suggestion->media = $filename;
            $suggestion->save();
        }

        // evolution: redirect to main page?
        return redirect()->route('suggestions.index')->with('success', 'your suggestion has been submitted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $suggestion = Suggestion::findOrFail($id);
        return view('suggestions.show', compact('suggestion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $suggestion = Suggestion::findOrFail($id);
        return view('suggestions.edit', compact('suggestion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // evolution: remove this feature (realistically not needed)
        // just there to test the CRUD
        $suggestion = Suggestion::findOrFail($id);
        $suggestion->update($request->all());
        return redirect()->route('suggestions.index')->with('success', 'Suggestion updated.');
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
