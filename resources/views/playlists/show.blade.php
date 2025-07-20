@extends('layouts.app')

@section('title', 'playlist informations')

@section('content')
    <h1>{{ $playlist->name }}</h1>
    <!-- only let admins and playlist owner add maps to the playlist -->
    @if(Auth::check() && Auth::user()->id === $playlist->user_id || Auth::user()->type === "admin")
        <a href="{{ route('playlists.addMaps', $playlist->id) }}"><h2>add maps to playlist</h2></a> <br>
    @endif

    <div>
        <div>
            <div class="key">description</div>
            @if ($playlist->description)
                <span>{{ $playlist->description }}</span>
            @else
                <span>n/a</span>
            @endif
        </div>
        <div>
            <div class="key">created by <a href="{{ route('users.profile', $playlist->user->id) }}"><span>{{ $playlist->user->username }}</span></a></div>
        </div>

        <!-- list of maps from the playlist - if empty, displays specific text -->
        <div>
            <div class="key">list of maps</div>
            @if ($maps->isNotEmpty())
                @include('partials.mapList', ['maps' => $maps, 'devMode' => false])
            @else
                <div>this playlist is currently empty.</div>
            @endif
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