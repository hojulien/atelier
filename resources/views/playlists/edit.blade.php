@extends('layouts.app')

@section('title', 'edit playlist')

@section('content')
    <h1>edit playlist</h1>
    
    <form class="form m-auto g-10" id="playlistForm" method="POST" action="{{ route('playlists.update', $playlist) }}">
        @csrf
        @method('PUT')
        
        @include('partials.playlistForm', ['playlist' => $playlist])

        <button type="submit" class="button return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/update.svg') }}" alt="update icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/update_dark.svg') }}" alt="update icon dark mode">
            update playlist</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/forms/playlist.js')
@endsection