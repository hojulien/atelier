@extends('layouts.app')

@section('title', 'admin dashboard')

@section('content')
    <h1>welcome to the admin dashboard.</h1>
    <p>an easy hub to access to relevant data!</p>

    <div class="dashboard max-w-1200 m-auto p-20 g-30 flex flex-f-center">
        <div class="dashboard-option flex flex-col flex-f-center p-20 g-30 round-10">
            <p class="flex flex-f-center g-5 bold fsize-24">users
                <img class="iconLight icon-32" src="{{ asset('images/icons/user.svg') }}" alt="user icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/user_dark.svg') }}" alt="user icon darkmode">
            </p>
            <p class="bold fsize-32">{{ $userCount }}</p>
            <a class="bold fsize-20" href="{{ route('users.index') }}">user list</a>
        </div>
        <div class="dashboard-option flex flex-col flex-f-center p-20 g-30 round-10">
            <p class="flex flex-f-center g-5 bold fsize-24">maps
                <img class="iconLight icon-32" src="{{ asset('images/icons/map.svg') }}" alt="map icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/map_dark.svg') }}" alt="map icon darkmode">
            </p>
            <p class="bold fsize-32">{{ $mapCount }}</p>
            <p><a class="bold fsize-20" href="{{ route('maps.index') }}">map list</a> /// <a class="bold fsize-20" href="{{ route('maps.add') }}">add a new map</a> </p>
        </div>
        <div class="dashboard-option flex flex-col flex-f-center p-20 g-30 round-10">
            <p class="flex flex-f-center g-5 bold fsize-24">playlists
                <img class="iconLight icon-32" src="{{ asset('images/icons/playlist.svg') }}" alt="playlist icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/playlist_dark.svg') }}" alt="playlist icon darkmode">
            </p>
            <p class="bold fsize-32">{{ $playlistCount }}</p>
            <a class="bold fsize-20" href="{{ route('playlists.index') }}">playlist list</a>
        </div>
        <div class="dashboard-option flex flex-col flex-f-center p-20 g-30 round-10">
            <p class="flex flex-f-center g-5 bold fsize-24">suggestions
                <img class="iconLight icon-32" src="{{ asset('images/icons/suggestion.svg') }}" alt="suggestion icon">
                <img class="iconDark icon-32" src="{{ asset('images/icons/suggestion_dark.svg') }}" alt="suggestion icon darkmode">
            </p>
            <p class="bold fsize-32">{{ $suggestionCount }}</p>
            <a class="bold fsize-20" href="{{ route('suggestions.index') }}">suggestion list</a>
        </div>
    </div>
@endsection