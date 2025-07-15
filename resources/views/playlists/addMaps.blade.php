@extends('layouts.app')

@section('title', 'add maps to playlist')

@section('content')
    <h1>add maps to playlist</h1>

    <p>select the maps you would like to add to "{{ $playlist->name }}".</p>

    <label for="selectAll">select all maps</label>
    <input type="checkbox" name="selectAll" id="selectAll">
    
    <form method="POST" action="{{ route('playlists.updateMaps', $playlist->id) }}">
        @csrf

        <!-- evolution: update partials for mapList with a compact version -->
        <div class="map-container flex flex-col flex-y-center p-10 g-20">
        @foreach($maps as $map)
            <label>
                <input type="checkbox" name="map_id[]" value="{{ $map->id }}" hidden @if(in_array($map->id, $existingMaps)) checked @endif>
                <div class="map-card-compact flex p-10"
                    style="background-image: linear-gradient(to right,rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)), url('{{ asset('storage/images/maps_background/' . $map->background) }}');">
                    <div class="map-data-compact flex flex-col flex-x-center p-10">
                        <span>{{ $map->artist }}</span>
                        <span>{{ $map->title }}</span>
                    </div>
                    <div class="map-right-container g-10 flex">
                        <div class="map-settings-compact g-10 flex flex-col">
                            <div class="map-settings-card-compact flex flex-f-center p-5 g-3 medium-card" id="cs">
                                <span>CS</span>
                                <span>{{ trim_float($map->cs) }}</span>
                            </div>
                            <div class="map-settings-card-compact flex flex-f-center p-5 g-3 medium-card" id="hp">
                                <span>HP</span>
                                <span>{{ trim_float($map->hp) }}</span>
                            </div>
                            <div class="map-settings-card-compact flex flex-f-center p-5 g-3 medium-card" id="ar">
                                <span>AR</span>
                                <span>{{ trim_float($map->ar) }}</span>
                            </div>
                            <div class="map-settings-card-compact flex flex-f-center p-5 g-3 medium-card" id="od">
                                <span>OD</span>
                                <span>{{ trim_float($map->od) }}</span>
                            </div>
                            <div class="map-settings-card-compact flex flex-f-center p-5 medium-card" id="sr">
                                <span>{{ number_format(ceil($map->sr * 100) / 100, 2) }}★</span>
                            </div>
                            <div class="map-settings-card-compact flex flex-f-center p-5 medium-card" id="length">
                                <span>{{ gmdate('i:s', $map->length) }}</span>
                            </div>
                            <div class="map-settings-card-compact flex flex-f-center g-5 large-card" id="favorite-compact">
                                <img id="heart-icon-compact" class="iconLight" src="{{ asset('images/icons/unlike.svg') }}" alt="unlike icon">
                                <img id="heart-icon-compact" class="iconDark" src="{{ asset('images/icons/unlike_dark.svg') }}" alt="unlike icon dark mode">
                                <span>{{ $map->liked_by_users_count }}</span>
                            </div>
                        </div>
                        <div class="map-actions flex g-10">
                            <a class="map-actions-card-compact flex flex-f-center p-5 g-5 view no-link" href="{{ route('maps.show', $map->id) }}">
                                <img width="20" height="20" class="iconLight" src="{{ asset('images/icons/view.svg') }}" alt="view icon">
                                <img width="20" height="20" class="iconDark" src="{{ asset('images/icons/view_dark.svg') }}" alt="view icon dark mode">
                            </a>
                            <a class="map-actions-card-compact flex flex-f-center p-5 g-5 link-osu no-link" href="{{ "https://osu.ppy.sh/beatmapsets/" . $map->setId . "#osu/" . $map->mapId }}" target="_blank">
                                <img width="20" height="20" class="iconLight" src="{{ asset('images/icons/osu_logo.svg') }}" alt="osu! logo">
                                <img width="20" height="20" class="iconDark" src="{{ asset('images/icons/osu_logo_dark.svg') }}" alt="osu! logo dark mode">
                                <span>link</span>
                            </a>
                        </div>
                    </div>
                </div>
            </label>
        @endforeach
        </div>
        <button type="submit" style="background-color:palegreen;">update playlist</button>
    </form>
@endsection

@section('scripts')
    <script>
        let selectAll = document.getElementById("selectAll");
        selectAll.addEventListener('change', () => {
            document.querySelectorAll('input[type="checkbox"][type][hidden]').forEach(checkbox => {
            checkbox.checked = !checkbox.checked;
            });
        });
    </script>
@endsection