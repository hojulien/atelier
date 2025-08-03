@extends('layouts.app')

@section('title', 'playlist list')

@section('content')
    <div class="max-w-1200 m-auto p-20">
        <h1 class="title round-20">playlist list</h1>
    </div>

    @if (Auth::check())
    <a id="addMap" class="max-w-600 w-full m-auto button round-20 p-10 no-link bold edit flex flex-f-center g-5" href="{{ route('playlists.create') }}">
            <img class="iconLight icon-24" src="{{ asset('images/icons/add.svg') }}" alt="add icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/add_dark.svg') }}" alt="add icon dark mode">
            create a new playlist
    </a>
    @endif

    <form class="form m-auto p-20 g-10" method="GET" action="{{ route('playlists.index') }}">
        <!-- searchbar -->
        <input type="text" name="search" placeholder="search playlist..." value="{{ request('search') }}">

        <!-- search options -->
        <select name="filter" id="filter">
            <option value="default">search by...</option>
            <option value="name" {{ request('filter') == 'name' ? 'selected' : '' }}>name</option>
            <option value="creator" {{ request('filter') == 'creator' ? 'selected' : '' }}>creator</option>
        </select>

        <!-- sorting options -->
        <select name="sortby" id="sortby">
            <option value="">sort by...</option>
            <option value="name" {{ request('sortby') == 'name' ? 'selected' : '' }}>name</option>
            <option value="creator" {{ request('sortby') == 'creator' ? 'selected' : '' }}>creator</option>
            <option value="number_maps" {{ request('sortby') == 'number_maps' ? 'selected' : '' }}>number of maps</option>
            <option value="length" {{ request('sortby') == 'length' ? 'selected' : '' }}>length</option>
        </select>

        <!-- sorting directions (asc/desc) -->
        <select name="order" id="order">
            <option value="asc">ascending</option>
            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>descending</option>
        </select>

        <!-- make the number of playlists per page persist between forms -->
        <input type="hidden" name="playlists_per_page" value="{{ request('per_page', 10) }}">

        <br>
        <button type="submit" class="button round-20 return p-10 bold w-full max-w-600 flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/search.svg') }}" alt="search icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/search_dark.svg') }}" alt="search icon dark mode">
            search</button>
    </form>
 
    @include('partials.playlistList', ['playlists' => $playlists])
    {{ $playlists->onEachSide(2)->links('vendor.pagination.defaultPlaylist') }}
@endsection