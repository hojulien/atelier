@extends('layouts.app')

@section('title', 'map list')

@section('content')
    <h1>map list</h1>

    <!-- for accessibility purposes, to remove later -->
    @if (Auth::check() && Auth::user()->type === 'admin')
        <a href="{{ route('maps.create') }}"><h2>add new map</h2></a> <br>
        <label for="admin-actions">dev mode</label>
        <input type="checkbox" name="admin-actions" id="admin-actions">
    @endif

    <!-- TO DO: replace by artistunicode/titleunicode with a js script -->
    <div class="map-container flex flex-col flex-y-center p-20">
    @foreach($maps as $map)
        <div class="map-card flex p-20"
            style="background-image: linear-gradient(to right,rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)), url('{{ asset('storage/images/maps_background/' . $map->background) }}');">
            <div class="map-data flex flex-col p-20">
                <span>{{ $map->artist }}</span>
                <span>{{ $map->title }}</span>
            </div>
            <div class="map-right-container flex flex-col">
                <div class="map-settings flex">
                    <div class="map-settings-card flex flex-col flex-f-center small-card" id="cs">
                        <span>CS</span>
                        <span>{{ trim_float($map->cs) }}</span>
                    </div>
                    <div class="map-settings-card flex flex-col flex-f-center small-card" id="hp">
                        <span>HP</span>
                        <span>{{ trim_float($map->hp) }}</span>
                    </div>
                    <div class="map-settings-card flex flex-col flex-f-center small-card" id="ar">
                        <span>AR</span>
                        <span>{{ trim_float($map->ar) }}</span>
                    </div>
                    <div class="map-settings-card flex flex-col flex-f-center small-card" id="od">
                        <span>OD</span>
                        <span>{{ trim_float($map->od) }}</span>
                    </div>
                    <div class="map-settings-card flex flex-col flex-f-center medium-card" id="sr">
                        <span>SR</span>
                        <span>{{ number_format(ceil($map->sr * 100) / 100, 2) }}★</span>
                    </div>
                    <div class="map-settings-card flex flex-col flex-f-center large-card" id="length">
                        <span>LENGTH</span>
                        <span>{{ gmdate('i:s', $map->length) }}</span>
                    </div>
                    <div class="map-settings-card flex flex-col flex-f-center medium-card" id="favorite">
                        <img id="heart-icon" class="iconLight" src="{{ asset('images/icons/unlike.svg') }}" alt="unlike icon">
                        <img id="heart-icon" class="iconDark" src="{{ asset('images/icons/unlike_dark.svg') }}" alt="unlike icon dark mode">
                        <span>{{ $map->liked_by_users_count }}</span>
                    </div>
                </div>
                <div class="map-actions flex g-20">
                    <a class="map-actions-card flex flex-f-center g-5 invisible edit no-link" href="{{ route('maps.edit', $map->id) }}">
                        <img width="24" height="24" class="iconLight" src="{{ asset('images/icons/edit.svg') }}" alt="edit icon">
                        <img width="24" height="24" class="iconDark" src="{{ asset('images/icons/edit_dark.svg') }}" alt="edit icon dark mode">
                        <span class="action">edit</span>
                    </a>
                    <form class="map-actions-card flex flex-f-center g-5 invisible delete" action="{{ route('maps.delete', $map) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="no-button flex flex-f-center g-5" onclick="return confirm('delete this map? it will also be removed from associated playlists!');">
                            <img width="24" height="24" class="iconLight" src="{{ asset('images/icons/delete.svg') }}" alt="delete icon">
                            <img width="24" height="24" class="iconDark" src="{{ asset('images/icons/delete_dark.svg') }}" alt="delete icon dark mode">
                            <span class="action">delete</span>
                        </button>
                    </form>
                    <a class="map-actions-card flex flex-f-center g-5 view no-link" href="{{ route('maps.show', $map->id) }}">
                        <img width="24" height="24" class="iconLight" src="{{ asset('images/icons/view.svg') }}" alt="view icon">
                        <img width="24" height="24" class="iconDark" src="{{ asset('images/icons/view_dark.svg') }}" alt="view icon dark mode">
                        <span class="action">view</span>
                    </a>
                    <div class="map-actions-card flex flex-f-center g-5 link-osu">
                        @if(Auth::check() && Auth::user()->likedMaps()->find($map->id))
                            <form class="flex flex-y-center g-5 no-link" action="{{ route('maps.unlike', $map->id, Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="favorite no-button flex flex-f-center g-5" type="submit">
                                    <img width="24" height="24" class="iconLight" src="{{ asset('images/icons/unlike.svg') }}" alt="unlike icon">
                                    <img width="24" height="24" class="iconDark" src="{{ asset('images/icons/unlike_dark.svg') }}" alt="unlike icon dark mode">
                                    <span class="action">unfavorite</span>
                                </button>
                            </form>
                        @else
                            <form class="flex flex-y-center g-5 no-link" action="{{ route('maps.like', $map->id) }}" method="POST">
                                @csrf
                                <button class="favorite no-button flex flex-f-center g-5" type="submit">
                                    <img width="24" height="24" class="iconLight" src="{{ asset('images/icons/like.svg') }}" alt="like icon">
                                    <img width="24" height="24" class="iconDark" src="{{ asset('images/icons/like_dark.svg') }}" alt="like icon dark mode">
                                    <span class="action">favorite</span>
                                </button>
                            </form>
                        @endif
                    </div>
                    <a class="map-actions-card flex flex-f-center g-5 link-osu no-link" href="{{ "https://osu.ppy.sh/beatmapsets/" . $map->setId . "#osu/" . $map->mapId }}" target="_blank">
                        <img width="24" height="24" class="iconLight" src="{{ asset('images/icons/osu_logo.svg') }}" alt="osu! logo">
                        <img width="24" height="24" class="iconDark" src="{{ asset('images/icons/osu_logo_dark.svg') }}" alt="osu! logo dark mode">
                        <span>link</span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endsection

@section('scripts')
    @vite('resources/js/devModeMap.js')
@endsection 