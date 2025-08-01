@extends('layouts.app')

@section('title', 'playlist informations')

@section('content')
    <div class="max-w-1200 m-auto p-20">
        <h1 class="title round-20">{{ $playlist->name }}</h1>
    </div>

    <!-- only let admins and playlist owner add maps to the playlist -->
    @if(Auth::check() && (Auth::user()->id === $playlist->user_id || Auth::user()->type === "admin"))
        <a href="{{ route('playlists.addMaps', $playlist->id) }}"><h2>add maps to playlist</h2></a> <br>
    @endif

    <div>
        <div class="max-w-1200 m-auto flex flex-col flex-f-center p-20 g-10">
            <div class="details-data flex g-20">
                <div class="details-key button round-20 flex flex-f-center g-5 m-auto">
                    <img class="iconLight icon-32" src="{{ asset('images/icons/description.svg') }}" alt="description icon">
                    <img class="iconDark icon-32" src="{{ asset('images/icons/description_dark.svg') }}" alt="description icon darkmode">
                    <span class="bold">description</span>
                </div>
                <div class="details-value button round-20 flex flex-f-center">
                    @if ($playlist->description)
                        <span class="description">{{ $playlist->description }}</span>
                    @else
                        <span>n/a</span>
                    @endif
                </div>
            </div>
            <div class="details-data flex g-20">
                <div class="details-key button round-20  flex flex-f-center g-5 m-auto">
                    <img class="iconLight icon-32" src="{{ asset('images/icons/user.svg') }}" alt="user icon">
                    <img class="iconDark icon-32" src="{{ asset('images/icons/user.svg') }}" alt="user icon darkmode">
                    <span class="bold">created by</span>
                </div>
                <div class="details-value button round-20 flex flex-f-center">
                    <a href="{{ route('users.profile', $playlist->user->id) }}"><span>{{ $playlist->user->username }}</span></a>
                </div>
            </div>
        </div>

        <!-- list of maps from the playlist - if empty, displays specific text -->
        <div class="max-w-1200 m-auto p-20">
            <h1 class="title round-20">list of maps</h1>
        </div>
        <div>
            @if ($maps->isNotEmpty())
                @include('partials.mapList', ['maps' => $maps, 'devMode' => false])
            @else
                <div>this playlist is currently empty.</div>
            @endif
        </div>

    </div>

    @if(Auth::check() && (Auth::user()->id === $playlist->user_id || Auth::user()->type === "admin"))
        <div class="details-data flex flex-f-center g-20">
            
            <a id="edit" class="button p-10 no-link bold edit flex flex-f-center g-5 round-20" href="{{ route('playlists.edit', $playlist->id) }}">
                <img class="iconLight icon-24" src="{{ asset('images/icons/edit.svg') }}" alt="edit icon">
                <img class="iconDark icon-24" src="{{ asset('images/icons/edit_dark.svg') }}" alt="edit icon dark mode">
                edit playlist
            </a>

            <form class="button p-10 delete round-20" action="{{ route('playlists.delete', $playlist) }}" method="POST">
                @csrf
                @method('DELETE')
                <button 
                    onclick="return confirm('delete this playlist? it cannot be recovered!');" 
                    id="delete"
                    class="no-button bold flex flex-f-center g-5">
                    <img class="iconLight icon-24" src="{{ asset('images/icons/delete.svg') }}" alt="delete icon">
                    <img class="iconDark icon-24" src="{{ asset('images/icons/delete_dark.svg') }}" alt="delete icon dark mode">
                    delete playlist
                </button>
            </form>

            <!-- for admins, return to user list -->
            @if (Auth::check() && Auth::user()->type === "admin")
                <a href="{{ route('playlists.index') }}" class="no-link button return p-10 bold flex flex-f-center g-5 round-20">
                    <img class="iconLight icon-24" src="{{ asset('images/icons/return.svg') }}" alt="return icon">
                    <img class="iconDark icon-24" src="{{ asset('images/icons/return_dark.svg') }}" alt="return icon dark mode">
                    back to playlist list
                </a>
            @endif
        </div>
    @endif
    
@endsection