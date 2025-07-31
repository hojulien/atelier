<div class="map-container max-w-1200 m-auto flex flex-col flex-y-center p-20 g-30">
    @foreach($maps as $map)
        <div class="map-card round-30 flex p-20"
            style="background-image: linear-gradient(to right,rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)), url('{{ asset('storage/images/maps_background/' . $map->background) }}'); cursor: pointer;"
            onclick="window.location='{{ route('maps.details', $map->id) }}'">

            <!-- map-data - contains artist name and song title -->
            <div class="map-data round-20 flex flex-col p-20">
                <span>{{ $map->artist }}</span>
                <span>{{ $map->title }}</span>
            </div>

            <!-- map-right-container - contains settings and action buttons -->
            <div class="map-right-container g-20 flex flex-col">

                <!-- map-settings - all informations regarding the map -->
                <div class="map-settings flex">
                    <div class="map-settings-card flex flex-col flex-f-center p-10 round-10 small-card" id="cs">
                        <span>CS</span>
                        <span>{{ trim_float($map->cs) }}</span>
                    </div>
                    <div class="map-settings-card flex flex-col flex-f-center p-10 round-10 small-card" id="hp">
                        <span>HP</span>
                        <span>{{ trim_float($map->hp) }}</span>
                    </div>
                    <div class="map-settings-card flex flex-col flex-f-center p-10 round-10 small-card" id="ar">
                        <span>AR</span>
                        <span>{{ trim_float($map->ar) }}</span>
                    </div>
                    <div class="map-settings-card flex flex-col flex-f-center p-10 round-10 small-card" id="od">
                        <span>OD</span>
                        <span>{{ trim_float($map->od) }}</span>
                    </div>
                    <div class="map-settings-card flex flex-col flex-f-center p-10 round-10 medium-card" id="sr">
                        <span>SR</span>
                        <span>{{ number_format(ceil($map->sr * 100) / 100, 2) }}★</span>
                    </div>
                    <div class="map-settings-card flex flex-col flex-f-center p-10 round-10 large-card" id="length">
                        <span>LENGTH</span>
                        <span>{{ gmdate('i:s', $map->length) }}</span>
                    </div>
                    <div class="map-settings-card flex flex-col flex-f-center p-10 round-10 medium-card" id="favorite">
                        <img id="heart-icon" class="iconLight" src="{{ asset('images/icons/unlike.svg') }}" alt="unlike icon">
                        <img id="heart-icon" class="iconDark" src="{{ asset('images/icons/unlike_dark.svg') }}" alt="unlike icon dark mode">
                        <span>{{ $map->liked_by_users_count }}</span>
                    </div>
                </div>

                <!-- map-actions - actions to perform for each map (favorite/link) -->
                <div class="map-actions flex g-20">

                    <!-- only show edit/delete button if dev mode is enabled (only visible from the admin) -->
                    @if ($devMode)
                    <a class="map-actions-card flex flex-f-center p-10 g-5 round-10 invisible edit no-link" href="{{ route('maps.edit', $map->id) }}" onclick="event.stopPropagation();">
                        <img class="iconLight icon-24" src="{{ asset('images/icons/edit.svg') }}" alt="edit icon">
                        <img class="iconDark icon-24" src="{{ asset('images/icons/edit_dark.svg') }}" alt="edit icon dark mode">
                        <span class="action">edit</span>
                    </a>
                    <form class="map-actions-card flex flex-f-center p-10 g-5 round-10 invisible delete" action="{{ route('maps.delete', $map) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="no-button flex flex-f-center g-5" onclick="return confirm('delete this map? it will also be removed from associated playlists!');">
                            <img class="iconLight icon-24" src="{{ asset('images/icons/delete.svg') }}" alt="delete icon">
                            <img class="iconDark icon-24" src="{{ asset('images/icons/delete_dark.svg') }}" alt="delete icon dark mode">
                            <span class="action">delete</span>
                        </button>
                    </form>
                    @endif

                    <!-- checks if user is logged in and has favorited the map -->
                    <div class="map-actions-card flex flex-f-center p-10 g-5 round-10 link-osu">
                        @if(Auth::check() && Auth::user()->likedMaps()->find($map->id))
                            <form class="flex flex-y-center g-5 no-link" action="{{ route('maps.unlike', $map->id, Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="favorite no-button flex flex-f-center g-5" type="submit">
                                    <img class="iconLight icon-24" src="{{ asset('images/icons/unlike.svg') }}" alt="unlike icon">
                                    <img class="iconDark icon-24" src="{{ asset('images/icons/unlike_dark.svg') }}" alt="unlike icon dark mode">
                                    <span class="action">unfavorite</span>
                                </button>
                            </form>
                        @else
                            <form class="flex flex-y-center g-5 no-link" action="{{ route('maps.like', $map->id) }}" method="POST">
                                @csrf
                                <button class="favorite no-button flex flex-f-center g-5" type="submit">
                                    <img class="iconLight icon-24" src="{{ asset('images/icons/like.svg') }}" alt="like icon">
                                    <img class="iconDark icon-24" src="{{ asset('images/icons/like_dark.svg') }}" alt="like icon dark mode">
                                    <span class="action">favorite</span>
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- constructs an osu url to redirect to the map's official page -->
                    <a class="map-actions-card flex flex-f-center p-10 g-5 round-10 link-osu no-link" href="{{ "https://osu.ppy.sh/beatmapsets/" . $map->setId . "#osu/" . $map->mapId }}" target="_blank" onclick="event.stopPropagation();">
                        <img class="iconLight icon-24" src="{{ asset('images/icons/osu_logo.svg') }}" alt="osu! logo">
                        <img class="iconDark icon-24" src="{{ asset('images/icons/osu_logo_dark.svg') }}" alt="osu! logo dark mode">
                        <span>link</span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    {{ $maps->onEachSide(2)->links('vendor.pagination.defaultMaps') }}
</div>