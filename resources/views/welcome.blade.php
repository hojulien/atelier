@extends('layouts.app')

@section('title', 'home')

@section('content')
    <h1>welcome!</h1>
    <div class="home-container flex flex-col g-10">
        <p>this website aims to provide advanced filters that the osu! website doesn't have, such as 
            <strong>playlists</strong> and a more exhaustive <strong>filter by tags</strong>.</p>
        <p>this isn't meant to replace the osu!'s beatmap
            search system, but more to build something that
            meets specific needs.</p>
        <p>how about checking out our playlists? with an
            account, you can make your own too!</p>
        <strong><p>note: this website is NOT affiliated with osu! and
        is a fan-made project.</p></strong>
    </div>

    @if ($playlists->isNotEmpty())
        @include('partials.playlistList', ['playlists' => $playlists])
    @else
        <div class="fsize-24 bold p-20">no admin public playlists available.</div>
    @endif
@endsection