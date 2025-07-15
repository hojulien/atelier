@extends('layouts.app')

@section('title', 'edit playlist')

@section('content')
    <h1>edit playlist</h1>
    
    <form class="form" id="playlistForm" method="POST" action="{{ route('playlists.update', $playlist) }}">
        @csrf
        @method('PUT')
        
        @include('partials.playlistForm', ['playlist' => $playlist])

        <button type="submit" style="background-color:palegreen;">update playlist</button>
    </form>
@endsection

@section('scripts')
    @vite('resources/js/forms/playlist.js')
@endsection