@extends('layouts.app')

@section('title', 'playlist list')

@section('content')
    <h1>playlist list</h1>

    <!-- for accessibility purposes, to remove later -->
    <a href="{{ route('playlists.create') }}"><h2>create a playlist</h2></a>

    <div class="playlist-header flex flex-f-center p-20">
            <span>name</span>
            <span>number of maps</span>
            <span>length</span>
            <span>creator</span>
    </div>
    
    @include('partials.playlistList', ['playlists' => $playlists])
@endsection