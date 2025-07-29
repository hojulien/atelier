@extends('layouts.app')

@section('title', 'create a new playlist')

@section('content')
    <div class="max-w-1000 m-auto p-20">
        <h1 class="title round-20">create a new playlist</h1>
    </div>
    
    <form class="form m-auto g-10 p-20" id="playlistForm" method="POST" action="{{ route('playlists.store') }}">
        @csrf

        @include('partials.playlistForm', ['playlist' => null])

        <button type="submit" class="button round-20 return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/edit.svg') }}" alt="create icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/edit_dark.svg') }}" alt="create icon dark mode">
            create playlist</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/forms/playlist.js')
@endsection