@extends('layouts.app')

@section('title', 'create a new playlist')

@section('content')
    <h1>create a new playlist</h1>
    
    <form method="POST" action="{{ route('playlists.store') }}">
        @csrf

        @include('partials.playlistForm', ['playlist' => null])

        <button type="submit" style="background-color:palegreen;">create playlist</button>
    </form>
@endsection