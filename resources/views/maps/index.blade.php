@extends('layouts.app')

@section('title', 'map list')

@section('content')
    <div class="title-container p-20">
        <h1 class="title">map list</h1>
    </div>

    @if (Auth::check() && Auth::user()->type === 'admin')
        <a href="{{ route('maps.add') }}"><h2>add new map</h2></a> <br> <!-- for accessibility purposes, to remove later -->
        <label for="admin-actions">dev mode</label>
        <input type="checkbox" name="admin-actions" id="admin-actions">
    @endif

    <br>

    <form class="form m-auto g-10" method="GET" action="{{ route('maps.index') }}">
        <!-- searchbar -->
        <input type="text" name="search" placeholder="search map..." value="{{ request('search') }}">

        <!-- search options -->
        <select name="filter" id="filter">
            <option value="default">search by...</option>
            <option value="creator" {{ request('filter') == 'creator' ? 'selected' : '' }}>creator</option>
            <option value="artist" {{ request('filter') == 'artist' ? 'selected' : '' }}>artist</option>
            <option value="title" {{ request('filter') == 'title' ? 'selected' : '' }}>title</option>
        </select>

        <!-- sorting options -->
        <select name="sortby" id="sortby">
            <option value="">sort by...</option>
            <option value="artist" {{ request('sortby') == 'artist' ? 'selected' : '' }}>artist</option>
            <option value="title" {{ request('sortby') == 'title' ? 'selected' : '' }}>title</option>
            <option value="sr" {{ request('sortby') == 'sr' ? 'selected' : '' }}>difficulty</option>
            <option value="length" {{ request('sortby') == 'length' ? 'selected' : '' }}>length</option>
            <option value="cs" {{ request('sortby') == 'cs' ? 'selected' : '' }}>cs</option>
            <option value="hp" {{ request('sortby') == 'hp' ? 'selected' : '' }}>hp</option>
            <option value="ar" {{ request('sortby') == 'ar' ? 'selected' : '' }}>ar</option>
            <option value="od" {{ request('sortby') == 'od' ? 'selected' : '' }}>od</option>
            <option value="submitDate" {{ request('sortby') == 'submitDate' ? 'selected' : '' }}>submit date</option>
            <option value="lastUpdated" {{ request('sortby') == 'lastUpdated' ? 'selected' : '' }}>last updated</option>
        </select>

        <!-- sorting directions (asc/desc) -->
        <select name="order" id="order">
            <option value="asc">ascending</option>
            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>descending</option>
        </select>

        <!-- make the number of maps per page persist between forms -->
        <input type="hidden" name="maps_per_page" value="{{ request('per_page', 10) }}">

        <br>
        <button type="submit" class="button return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/search.svg') }}" alt="search icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/search_dark.svg') }}" alt="search icon dark mode">
            search</button>
    </form>

    <!-- TO DO: replace by artistunicode/titleunicode with a js script -->
    @include('partials.mapList', ['maps' => $maps, 'devMode' => true])
@endsection

@section('scripts')
    @vite('resources/js/devModeMap.js')
@endsection 