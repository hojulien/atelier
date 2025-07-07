@extends('layouts.app')

@section('title', 'map list')

@section('content')
    <h1>hi</h1>

    <!-- for accessibility purposes, to remove later -->
    <a href="{{ route('maps.create') }}"><h2>add new map</h2></a>
    <label for="admin-actions">dev mode</label>
    <input type="checkbox" name="admin-actions" id="admin-actions">

    <!-- TO DO: replace by artistunicode/titleunicode with a js script -->
    <div class="map-container">
    @foreach($maps as $map)
        <div class="map-card"
            style="background-image: linear-gradient(to right,rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)), url('{{ asset('storage/images/maps_background/' . $map->background) }}');">
            <div class="map-data">
                <span>{{ $map->artist }}</span>
                <span>{{ $map->title }}</span>
            </div>
            <div class="map-right-container">
                <div class="map-settings">
                    <div class="map-settings-card small-card" id="cs">
                        <span>CS</span>
                        <span>{{ trim_float($map->cs) }}</span>
                    </div>
                    <div class="map-settings-card small-card" id="hp">
                        <span>HP</span>
                        <span>{{ trim_float($map->hp) }}</span>
                    </div>
                    <div class="map-settings-card small-card" id="ar">
                        <span>AR</span>
                        <span>{{ trim_float($map->ar) }}</span>
                    </div>
                    <div class="map-settings-card small-card" id="od">
                        <span>OD</span>
                        <span>{{ trim_float($map->od) }}</span>
                    </div>
                    <div class="map-settings-card large-card" id="sr">
                        <span>SR</span>
                        <span>{{ number_format(ceil($map->sr * 100) / 100, 2) }}★</span>
                    </div>
                    <div class="map-settings-card large-card" id="length">
                        <span>LENGTH</span>
                        <span>{{ gmdate('i:s', $map->length) }}</span>
                    </div>
                </div>
                <div class="map-actions">
                    <div class="map-actions-card invisible view">
                        <a class="no-link" href="{{ route('maps.show', $map->id) }}"><span>view</span></a>
                    </div>
                    <div class="map-actions-card invisible edit">
                        <a class="no-link" href="{{ route('maps.edit', $map->id) }}"><span>edit</span></a>
                    </div>
                    <div class="map-actions-card invisible delete">
                        <form action="{{ route('maps.delete', $map) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <span class="no-link" onclick="return confirm('delete this suggestion?');">delete</span>
                        </form>
                    </div>
                    <div class="map-actions-card link-osu">
                        <a class="map-card-link no-link" href="{{ "https://osu.ppy.sh/beatmapsets/" . $map->setId . "#osu/" . $map->mapId }}" target="_blank">
                            <img width="24" height="24" class="iconLight" src="{{ asset('images/icons/osu_logo.svg') }}" alt="osu! logo">
                            <img width="24" height="24" class="iconDark" src="{{ asset('images/icons/osu_logo_dark.svg') }}" alt="osu! logo dark mode">
                            <span>link</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endsection

@section('scripts')
    @vite('resources/js/devModeMap.js')
@endsection 