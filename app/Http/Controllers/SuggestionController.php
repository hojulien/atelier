<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{
    use AuthorizesRequests;

    // set rules and messages - protected means it can ONLY be accessed by its own class
    protected function rules() {
        $rules = [
            'type' => 'required|string',
            'description' => 'required|string',
            'media_file' => 'required_if:type,media|mimes:jpg,png|max:8192',
            'media_url' => [
                'required_if:type,music',
                'regex:/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[\w\-]{11}$/'
            ],
        ];

        return $rules;
    }

    protected function messages() {
        $messages = [
            'required' => ':attribute is required.',
            'media_file.required_if' => 'an image should be provided for the media suggestion.',
            'media_file.image' => 'media should be an image file.',
            'media_file.max' => 'image must not be larger than 8mb.',
            'media_url.required_if' => 'a link should be provided for the music suggestion.',
            'media_url.regex' => 'media should be a youtube link.'
        ];

        return $messages;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('maps_per_page', 10);
        $filter = $request->input('filter', 'default');

        if ($filter === 'archived') {
            $query = Suggestion::onlyTrashed(); // archived
        } else if ($filter === 'active' || $filter === 'default') {
            $query = Suggestion::query(); // non-archived
        } else {
            $query = Suggestion::withTrashed(); // fallback case
        }

        $suggestions = $query->paginate($perPage)->appends($request->query());

        return view('suggestions.index', compact('suggestions'));

    }

    public function create()
    {
        return view('suggestions.create');
    }

    public function store(Request $request)
    {
        // validates all inputs individually
        $validated = $request->validate($this->rules(), $this->messages());

        $validated['user_id'] = Auth::user()->id;

        // we need to transfer "media_file" or "media_url" over to "media"
        // so $suggestion cannot be created yet until $validated is finalized.
        // unset removes the values before pushing the final create command.
        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $file->storeAs('images/suggestions', $filename, 'public');
            $validated['media'] = $filename;
            unset($validated['media_file']);
        } else {
            $validated['media'] = $validated['media_url'];
            unset($validated['media_url']);
        }

        Suggestion::create($validated);

        // evolution: redirect to main page?
        return redirect()->route('home')->with('success', 'your suggestion has been submitted.');
    }

    public function show(string $id)
    {
        $suggestion = Suggestion::findOrFail($id);
        $this->authorize('view', $suggestion);
        return view('suggestions.show', compact('suggestion'));
    }

    public function edit(string $id)
    {
        $users = User::all();
        $suggestion = Suggestion::findOrFail($id);
        return view('suggestions.edit', compact('suggestion','users'));
    }

    public function update(Request $request, string $id)
    {
        // not needed, but left there for the admin to update if he needs to
        $suggestion = Suggestion::findOrFail($id);

        $validated = $request->validate($this->rules(), $this->messages());

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

    // soft deletes the entry, making it still exist in the database but not show up (unless using trashed())
    public function archive(string $id)
    {
        $suggestion = Suggestion::findOrFail($id);
        $suggestionId = $suggestion->id;
        $suggestion->delete();
        return redirect()->route('suggestions.index')->with('success', "suggestion n°{$suggestionId} archived.");
    }

    // undoes the soft delete
    public function restore(string $id)
    {
        $suggestion = Suggestion::withTrashed()->findOrFail($id);
        $suggestionId = $suggestion->id;
        $suggestion->restore();
        return redirect()->route('suggestions.index')->with('success', "suggestion n°{$suggestionId} restored.");
    }

    // fully delete the entry
    public function destroy(string $id)
    {
        $suggestion = Suggestion::findOrFail($id);
        $suggestionId = $suggestion->id;
        $suggestion->forceDelete();
        return redirect()->route('suggestions.index')->with('success', "suggestion n°{$suggestionId} deleted.");
    }
}
