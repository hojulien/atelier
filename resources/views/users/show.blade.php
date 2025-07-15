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

    <!-- shows user's favorited maps - if none, displays a custom text -->
    @if ($user->likedMaps->isNotEmpty())
        <h1>{{ $user->username }}'s favorited maps</h1>
        @include('partials.mapList', ['maps' => $user->likedMaps, 'devMode' => false])
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