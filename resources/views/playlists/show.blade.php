@extends('layouts.app')

@section('title', 'playlist informations')

@section('content')
    <h1>{{ $playlist->name }}</h1>
    <!-- only let admins and playlist owner add maps to the playlist -->
    @if(Auth::check() && Auth::user()->id === $playlist->user_id || Auth::user()->type === "admin")
        <a href="{{ route('playlists.addMaps', $playlist->id) }}"><h2>add maps to playlist</h2></a> <br>
    @endif

    <div>
        <div class="details-container flex flex-col flex-f-center p-20 g-10">
            <div class="details-data flex g-20">
                <div class="details-key button flex flex-f-center g-5 m-auto">
                    <img class="iconLight icon-32" src="{{ asset('images/icons/description.svg') }}" alt="description icon">
                    <img class="iconDark icon-32" src="{{ asset('images/icons/description_dark.svg') }}" alt="description icon darkmode">
                    <span class="bold">description</span>
                </div>
                <div class="details-value button flex flex-f-center">
                    @if ($playlist->description)
                        <span class="description">{{ $playlist->description }}</span>
                    @else
                        <span>n/a</span>
                    @endif
                </div>
            </div>
            <div class="details-data flex g-20">
                <div class="details-key button flex flex-f-center g-5 m-auto">
                    <img class="iconLight icon-32" src="{{ asset('images/icons/user.svg') }}" alt="user icon">
                    <img class="iconDark icon-32" src="{{ asset('images/icons/user.svg') }}" alt="user icon darkmode">
                    <span class="bold">created by</span>
                </div>
                <div class="details-value button flex flex-f-center">
                    <a href="{{ route('users.profile', $playlist->user->id) }}"><span>{{ $playlist->user->username }}</span></a>
                </div>
            </div>
        </div>

        <!-- list of maps from the playlist - if empty, displays specific text -->
        <div class="title-container p-20">
            <h1 class="title">list of maps</h1>
        </div>
        <div>
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