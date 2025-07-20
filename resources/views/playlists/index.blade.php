@extends('layouts.app')

@section('title', 'playlist list')

@section('content')
    <h1>playlist list</h1>

    <!-- for accessibility purposes, to remove later -->
    <a href="{{ route('playlists.create') }}"><h2>create a playlist</h2></a>

    <br>

    <form method="GET" action="{{ route('playlists.index') }}">
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
            <option value="number_levels" {{ request('sortby') == 'number_levels' ? 'selected' : '' }}>number of maps</option>
            <option value="length" {{ request('sortby') == 'length' ? 'selected' : '' }}>length</option>
        </select>

        <!-- sorting directions (asc/desc) -->
        <select name="order" id="order">
            <option value="asc">ascending</option>
            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>descending</option>
        </select>

        <!-- make the number of playlists per page persist between forms -->
        <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">

        <br>
        <button type="submit">search</button>
    </form>
 
    @include('partials.playlistList', ['playlists' => $playlists])
@endsection