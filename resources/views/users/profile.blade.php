@extends('layouts.app')

@section('title', 'user profile')

@section('content')

    <div class="details-container p-20">
        <div class="details-banner relative">
            <img src="{{ asset('storage/images/banners/' . $user->banner) }}" alt="user banner">
            <div class="profile absolute flex flex-f-center">
                <img src="{{ asset('storage/images/avatars/' . $user->avatar) }}" alt="avatar">
            </div>
        </div>
        <div class="details-profile flex flex-f-center g-20">
            <div class="profile profile-mobile flex flex-f-center">
                <img src="{{ asset('storage/images/avatars/' . $user->avatar) }}" alt="avatar">
            </div>
            <span class="username bold fsize-32">{{ $user->username }}</span>
            <div class="stats flex flex-col g-10">
                <div class="fsize-20">
                    <span class="fsize-24">{{ $user->playlists()->count() }}</span>
                    @if($user->playlists()->count() === 1)
                        playlist
                    @else
                        playlists
                    @endif
                    (<span class="fsize-24">{{ $user->playlists()->where('visibility','private')->count() }}</span> private)
                </div>
                <div class="fsize-20">
                    <span class="fsize-24">{{ $user->likedMaps()->count() }}</span> 
                    @if($user->likedMaps()->count() === 1)
                        favorited map
                    @else
                        favorited maps
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- shows user's playlists - if none, displays a custom text -->
    <div class="title-container p-20">
        <h1 class="title">{{ $user->username }}'s playlists</h1>
    </div>
    @if ($playlists->isNotEmpty())
        @include('partials.playlistList', ['playlists' => $playlists])
    @else
        <div class="fsize-24 bold p-20">this user doesn't have any registered public playlist.</div>
    @endif

    <!-- shows user's favorited maps - if none, displays a custom text -->
    <div class="title-container p-20">
        <h1 class="title">{{ $user->username }}'s favorited maps</h1>
    </div>
    @if ($likedMaps->isNotEmpty())
        @include('partials.mapList', ['maps' => $likedMaps, 'devMode' => false])
    @else
        <div class="fsize-24 bold p-20">this user doesn't have any favorited maps.</div>
    @endif

    <!-- displays user actions (edit, delete) -->
    @if (Auth::check() && Auth::user()->id === $user->id)
        <div class="details-data flex flex-f-center g-20">
            
            <a id="edit" class="button p-10 no-link bold edit flex flex-f-center g-5" href="{{ route('users.edit', $user->id) }}">
                <img width="24" height="24" class="iconLight" src="{{ asset('images/icons/edit.svg') }}" alt="edit icon">
                <img width="24" height="24" class="iconDark" src="{{ asset('images/icons/edit_dark.svg') }}" alt="edit icon dark mode">
                edit account
            </a>

            <form class="button p-10 delete" action="{{ route('users.delete', $user) }}" method="POST">
                @csrf
                @method('DELETE')
                <button 
                    onclick="return confirm('delete this map? it will also be removed from associated playlists!');" 
                    id="delete"
                    class="no-button bold flex flex-f-center g-5">
                    <img width="24" height="24" class="iconLight" src="{{ asset('images/icons/delete.svg') }}" alt="delete icon">
                    <img width="24" height="24" class="iconDark" src="{{ asset('images/icons/delete_dark.svg') }}" alt="delete icon dark mode">
                    delete account
                </button>
            </form>

            <!-- for admins, return to user list -->
            @if (Auth::check() && Auth::user()->type === "admin")
                <a href="{{ route('users.index') }}" class="no-link button return p-10 bold flex flex-f-center g-5">
                    <img width="24" height="24" class="iconLight" src="{{ asset('images/icons/return.svg') }}" alt="return icon">
                    <img width="24" height="24" class="iconDark" src="{{ asset('images/icons/return_dark.svg') }}" alt="return icon dark mode">
                    back to user list
                </a>
            @endif
        </div>
    @endif
    
@endsection