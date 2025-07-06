@extends('layouts.app')

@section('title', 'playlist informations')

@section('content')
    <!-- evolution: add list of maps from the playlist -->
    <h1>{{ $playlist->name }}</h1>

    <div>
        <div>
            <div class="key">description</div>
            <div>{{ $playlist->description }}</div>
        </div>
        <div>
            <div class="key">created by <span>{{ $playlist->user->username }}</span></div>
        </div>
        <div>
            <a id="edit" href="{{ route('playlists.edit', $playlist->id) }}">edit playlist</a>
            <form action="{{ route('playlists.delete', $playlist) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('delete this playlist?');" id="delete">delete playlist</button>
            </form>
        </div>
    </div>
    <button class="return"><a href="{{ route('playlists.index') }}" >back to playlist list</a></button>
    
@endsection