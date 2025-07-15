@extends('layouts.app')

@section('title', 'playlist list')

@section('content')
    <h1>playlist list</h1>

    <!-- for accessibility purposes, to remove later -->
    <a href="{{ route('playlists.create') }}"><h2>create a playlist</h2></a>

    <div class="playlist-header flex flex-f-center p-20">
            <span>name</span>
            <span>number of maps</span>
            <span>length</span>
            <span>creator</span>
    </div>
    <div class="playlist-container flex flex-col g-30">
        @foreach ($playlists as $playlist)
            <div 
                class="playlist-card flex flex-col"
                onclick="window.location='{{ route('playlists.show', $playlist->id) }}'"
                style="cursor:pointer;">
                <div class="playlist-informations flex flex-f-center p-20">
                    <span>@if($playlist->visibility === 'private') 🔒 @endif {{ $playlist->name }} </td></span>
                    <span>{{ $playlist->number_levels }} maps</span>
                    <span>
                        <!-- displays length value - manual mapping of h/m/s because we want to display >24 hours length -->
                        @php
                            $totalSeconds = $playlist->maps->sum('length');
                            $hours = floor($totalSeconds / 3600);
                            $minutes = floor(($totalSeconds % 3600) / 60);
                            $seconds = $totalSeconds % 60;
                        @endphp
                        {{ sprintf('%d:%02d:%02d', $hours, $minutes, $seconds) }}
                    </span>
                    <span>
                        <a href="{{ route('users.profile', $playlist->user->id) }}" onclick="event.stopPropagation();">
                                {{ $playlist->user->username }}
                        </a>
                    </span>
                </div>
                <div class="playlist-description flex flex-f-center">
                    @if ($playlist->description)
                        <span>{{ $playlist->description }}</span>
                    @else
                        <span>n/a</span>
                    @endif
                </div>
                <div class="playlist-thumbnails flex g-10">
                    @php
                        $maps = $playlist->maps->take(6); // first 6 maps
                        $remaining = $playlist->maps->count() - 6; // grab remaining number of maps
                    @endphp
                    @foreach($maps as $map)
                        <div class="thumbnail" style="background-image: url('{{ asset('storage/images/maps_background/' . $map->background) }}');"></div>
                    @endforeach
                    @if($remaining > 0)
                        <div class="thumbnail-more">
                            +{{ $remaining }} more...
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection