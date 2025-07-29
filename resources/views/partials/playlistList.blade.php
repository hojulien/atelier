<div class="playlist-container max-w-1200 m-auto flex flex-col p-20 g-30">
        <div class="playlist-header w-full flex flex-f-center p-20 round-20">
            <span>name</span>
            <span>number of maps</span>
            <span>length</span>
            <span>creator</span>
        </div>
        @foreach ($playlists as $playlist)
            <div 
                class="playlist-card flex flex-col w-full round-30"
                onclick="window.location='{{ route('playlists.show', $playlist->id) }}'"
                style="cursor:pointer;">

                <!-- playlist-informations: contains main information about playlist -->
                <div class="playlist-informations flex flex-f-center p-20">

                    <!-- playlist-information: individual information -->
                    <div class="playlist-information flex flex-f-center">
                        <div class="button round-20 playlist-icon">
                            <img class="iconLight icon-32" src="{{ asset('images/icons/title.svg') }}" alt="title icon">
                            <img class="iconDark icon-32" src="{{ asset('images/icons/title_dark.svg') }}" alt="title icon darkmode">
                        </div>
                        <span>@if($playlist->visibility === 'private') 🔒 @endif {{ $playlist->name }}</span>
                    </div>
                    <div class="playlist-information flex flex-f-center">
                        <div class="button round-20 playlist-icon">
                            <img class="iconLight icon-32" src="{{ asset('images/icons/map.svg') }}" alt="map icon">
                            <img class="iconDark icon-32" src="{{ asset('images/icons/map_dark.svg') }}" alt="map icon darkmode">
                        </div>
                        <span>{{ $playlist->number_maps }} maps</span>
                    </div>
                    <div class="playlist-information flex flex-f-center">
                        <!-- displays length value - manual mapping of h/m/s because we want to display >24 hours length -->
                        @php
                            $totalSeconds = $playlist->maps->sum('length');
                            $hours = floor($totalSeconds / 3600);
                            $minutes = floor(($totalSeconds % 3600) / 60);
                            $seconds = $totalSeconds % 60;
                        @endphp
                        <div class="button round-20 playlist-icon">
                            <img class="iconLight icon-32" src="{{ asset('images/icons/length.svg') }}" alt="length icon">
                            <img class="iconDark icon-32" src="{{ asset('images/icons/length_dark.svg') }}" alt="length icon darkmode">
                        </div>
                        <span>{{ sprintf('%d:%02d:%02d', $hours, $minutes, $seconds) }}</span>
                    </div>
                    <div class="playlist-information flex flex-f-center">
                        <div class="button round-20 playlist-icon">
                            <img class="iconLight icon-32" src="{{ asset('images/icons/user.svg') }}" alt="user icon">
                            <img class="iconDark icon-32" src="{{ asset('images/icons/user_dark.svg') }}" alt="user icon darkmode">
                        </div>
                        <span>
                            <a href="{{ route('users.profile', $playlist->user->id) }}" onclick="event.stopPropagation();">
                                {{ $playlist->user->username }}
                            </a>
                        </span>
                    </div>

                </div>

                <!-- playlist-description (n/a if empty) -->
                <div class="playlist-description flex flex-f-center p-20">
                    @if ($playlist->description)
                        <span>{{ $playlist->description }}</span>
                    @else
                        <span>n/a</span>
                    @endif
                </div>

                <!-- playlist-thumbnails: container for up to 6 thumbnails + more text -->
                <div class="playlist-thumbnails flex g-20">
                    @php
                        $maps = $playlist->maps->take(6); // first 6 maps
                        $remaining = $playlist->maps->count() - 6; // grab remaining number of maps
                    @endphp

                    <!-- display up to 6 thumbnails -->
                    @foreach($maps as $map)
                        <div class="thumbnail round-10" style="background-image: url('{{ asset('storage/images/maps_background/' . $map->background) }}');"></div>
                    @endforeach

                    <!-- show more if playlist has more than 6 maps -->
                    @if($remaining > 0)
                        <div class="thumbnail-more">
                            +{{ $remaining }} more...
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>