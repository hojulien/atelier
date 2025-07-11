@extends('layouts.app')

@section('title', 'user profile')

@section('content')
    <!-- evolution: rework into a proper "profile" -->
    <h1>{{ $user->username }}'s profile</h1>

    <div>
        <div>
            <div class="key">username</div>
            <div>{{ $user->username }}</div>
        </div>
        <div>
            <div class="key">avatar</div>
            <div><img width="128" height="128" src="{{ asset('storage/images/avatars/' . $user->avatar) }}" alt="avatar"></div>
        </div>
        <div>
            <div class="key">banner</div>
            <div><img width="auto" height="300" src="{{ asset('storage/images/banners/' . $user->banner) }}" alt="banner"></div>
        </div>
    </div>

    <!-- shows user's playlists - if none, displays a custom text -->
    <h1>{{ $user->username }}'s playlists</h1>
    @if ($user->playlists->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>number of levels</th>
                    <th>description</th>
                    <th>type</th>
                    <th>creator</th>
                    <th colspan="2">actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->playlists as $playlist)
                <tr>
                    <td>{{ $playlist->id }}</td>
                    <td>{{ $playlist->name }}</td>
                    <td>{{ $playlist->number_levels }}</td>
                    <td>{{ $playlist->description }}</td>
                    <td>{{ $playlist->type }}</td>
                    <td>{{ $playlist->user->username }}</td>
                    <td>
                        <a href="{{ route('playlists.show', $playlist->id) }}">view</a>
                    </td>
                    <td>
                        <a href="{{ route('playlists.edit', $playlist->id) }}">edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div>this user doesn't have any registered public playlist.</div>
    @endif

    <!-- shows user's playlists - if none, displays a custom text -->
    @if ($user->likedMaps->isNotEmpty())
        <h1>{{ $user->username }}'s favorited maps</h1>
        <div class="map-container">
        @foreach($user->likedMaps as $map)
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
    @endif


    <div>
        <a id="edit" href="{{ route('users.edit', $user->id) }}">edit profile</a>
        <form action="{{ route('users.delete', $user) }}" method="POST">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('delete this user account? all informations linked to it will be deleted as well!');" id="delete">delete profile</button>
        </form>
    </div>
    <button class="return"><a href="{{ route('users.index') }}" >back to user list</a></button>
    
@endsection