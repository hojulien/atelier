<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;

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
        return view('suggestions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // evolution: redirect to main page?
        $suggestion = $request->all();
        Suggestion::create($suggestion);
        return redirect()->route('suggestions.index')->with('success', 'Your suggestion has been submitted.');
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
