@extends('layouts.app')

@section('title', 'edit playlist')

@section('content')
    <!-- evolution: separate forms in a partial -->
    <h1>edit playlist</h1>
    
    <form method="POST" action="{{ route('playlists.update', $playlist) }}">
        @csrf
        @method('PUT')
        
        @include('partials.playlistForm', ['playlist' => $playlist])

        <button type="submit" style="background-color:palegreen;">update playlist</button>
    </form>
@endsection