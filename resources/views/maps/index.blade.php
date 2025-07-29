@extends('layouts.app')

@section('title', 'map list')

@section('content')
    <div class="max-w-1200 m-auto p-20">
        <h1 class="title round-20">map list</h1>
    </div>

    @if (Auth::check() && Auth::user()->type === 'admin')
        <a id="addMap" class="max-w-300 w-full m-auto hidden button round-20 p-10 no-link bold edit flex flex-f-center g-5" href="{{ route('maps.add') }}">
            <img class="iconLight icon-24" src="{{ asset('images/icons/add.svg') }}" alt="add icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/add_dark.svg') }}" alt="add icon dark mode">
            add a new map
        </a> <br>
        <div class="max-w-300 w-full m-auto bg-dark p-20">
            <label class="p-20" for="admin-actions">dev mode</label>
            <input type="checkbox" name="admin-actions" id="admin-actions">
        </div>
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
        <input type="hidden" name="maps_per_page" value="{{ request('maps_per_page', 10) }}">

        <br>

        <div class="tags-filter max-w-600 round-10 p-20 flex g-10">
            @foreach($tags as $tag)
            <label class="label-tag" for="{{ $tag }}">{{ $tag }}</label>
            <input type="checkbox" name="tags[]" value="{{ $tag }}"
                @if (in_array($tag, request()->input('tags', []))) checked @endif>
            @endforeach
        </div>
        
        <button type="submit" class="button round-20 return p-10 bold flex flex-f-center g-5">
            <img class="iconLight icon-24" src="{{ asset('images/icons/search.svg') }}" alt="search icon">
            <img class="iconDark icon-24" src="{{ asset('images/icons/search_dark.svg') }}" alt="search icon dark mode">
            <span>search</span>
        </button>
    </form>

    <!-- TO DO: replace by artistunicode/titleunicode with a js script -->

    @if ($maps->isNotEmpty())
        @include('partials.mapList', ['maps' => $maps, 'devMode' => true])
    @else
        <div class="fsize-24 bold p-20">no maps found.</div>
    @endif
@endsection

@section('scripts')
    @vite('resources/js/devModeMap.js')
@endsection 